<?php
require "../backend/conexion.php";
require '../backend/funciones.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ordenar_por'])) {
        $ordenar_por = sanitizar($_POST['ordenar_por']);
        $orden_preferido = sanitizar($_POST['orden_preferido']);
        $_SESSION['ordenar_por'] = $ordenar_por;
        $_SESSION['orden_preferido'] = $orden_preferido;
        
        echo json_encode(['estado' => 'exito', 'ordenar_por' => $_SESSION['ordenar_por'], 'orden_preferido' => $_SESSION['orden_preferido']]);
        die();
    }
    if (isset($_POST['producto_para_agregar']) && isset($_POST['cantidad']) && isset($_POST['interfaz']) && $_POST['interfaz'] === 'ingreso_ventas') {
        $ID_producto = (int) sanitizar($_POST['producto_para_agregar']);
        $cantidad = (int) sanitizar($_POST['cantidad']);
        $interfaz = sanitizar($_POST['interfaz']);

        $instruccion = 'SELECT
        p.ID_producto,
        p.nombre,
        p.precio,
        i.imagen
        FROM productos p 
        JOIN imagenes i 
        WHERE p.ID_producto = ' . $ID_producto . ' AND i.ID_producto = p.ID_producto AND p.activo = 1
        ';
        $resultado = mysqli_query($conn, $instruccion);

        mysqli_error($conn);

        $producto_a_seleccionar = [];
        if ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $producto_a_seleccionar['ID_producto'] = $fila['ID_producto'];
            $producto_a_seleccionar['nombre'] = $fila['nombre'];
            $producto_a_seleccionar['cantidad'] = $cantidad;
            $producto_a_seleccionar['precio'] = $fila['precio'];
            $producto_a_seleccionar['imagen'] = base64_encode($fila['imagen']);
        }
        mysqli_free_result($resultado);

        foreach($_SESSION['productos_seleccionados'] as $producto_seleccionado) {
            if($producto_a_seleccionar['ID_producto'] === $producto_seleccionado['ID_producto']) {
                Header('Location: ../interfaces/' . $interfaz . '.php');
                die();
            }
        }
        $_SESSION['productos_seleccionados'][] = $producto_a_seleccionar;
        Header('Location: ../interfaces/' . $interfaz . '.php');
        die();
    }
    if (isset($_POST['producto_para_agregar']) && isset($_POST['interfaz']) && $_POST['interfaz'] === 'ingreso_descuentos') {
        $ID_producto = (int) sanitizar($_POST['producto_para_agregar']);
        $interfaz = sanitizar($_POST['interfaz']);

        $instruccion = 'SELECT
        i.imagen,
        p.ID_producto,
        p.nombre,
        p.precio,
        p.stock,
        GROUP_CONCAT(DISTINCT c.nombre) AS categorias,
        IFNULL(
            GROUP_CONCAT(
                CASE 
                    WHEN d.ID_descuento IS NOT NULL AND d.fecha_expiracion > CURRENT_TIMESTAMP() 
                    THEN CONCAT(d.porcentaje, "%off")
                END
                ORDER BY d.porcentaje DESC 
                SEPARATOR ", "
            ),
            "ninguno"
        ) AS descuentos,
        SUM(
            CASE
                WHEN d.ID_descuento IS NOT NULL AND d.fecha_expiracion > CURRENT_TIMESTAMP()
                THEN d.porcentaje
                ELSE 0
            END
        ) AS porcentaje_total,
        d.activo
        FROM productos p
        JOIN categoria_productos cp
        ON cp.ID_producto = p.ID_producto
        JOIN categorias c
        ON c.ID_categoria = cp.ID_categoria
        LEFT JOIN descuento_productos dp
        ON dp.ID_producto = p.ID_producto
        LEFT JOIN descuentos d
        ON d.ID_descuento = dp.ID_descuento
        LEFT JOIN imagenes i
        ON i.ID_producto = p.ID_producto
        WHERE p.ID_producto =' . $ID_producto . ' AND p.activo = 1
        GROUP BY p.ID_producto'
        ;

        $resultado = mysqli_query($conn, $instruccion);
        $producto_a_seleccionar = [];
        if (mysqli_num_rows($resultado) > 0 && $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $producto_a_seleccionar['imagen'] = base64_encode($fila['imagen']);
            $producto_a_seleccionar['ID_producto'] = $fila['ID_producto'];
            $producto_a_seleccionar['nombre'] = $fila['nombre'];
            $producto_a_seleccionar['precio'] = $fila['precio'];
            $producto_a_seleccionar['stock'] = $fila['stock'];
            $producto_a_seleccionar['categorias'] = $fila['categorias'];
            $producto_a_seleccionar['descuentos'] = $fila['descuentos'];
            $producto_a_seleccionar['porcentaje_total'] = $fila['porcentaje_total'];
        } else {
            Header('Location: ../interfaces/' . $interfaz . '.php?advertencia=' . urlencode('Error de consulta. ' . mysqli_error($conn)));
            die();
        }
        mysqli_free_result($resultado);
        foreach($_SESSION['productos_seleccionados'] as $producto_seleccionado) {
            if($producto_a_seleccionar['ID_producto'] === $producto_seleccionado['ID_producto']) {
                Header('Location: ../interfaces/' . $interfaz . '.php');
                die();
            }
        }
        $_SESSION['productos_seleccionados'][] = $producto_a_seleccionar;

        Header('Location: ../interfaces/' . $interfaz . '.php');
        die();
    }
    if (isset($_POST['metodo_pago']) && isset($_POST['metodo_pago'])) {
        $metodo_pago = sanitizar($_POST['metodo_pago']);
        $_SESSION['metodo_pago'] = $metodo_pago;

        echo json_encode(['estado' => 'exito', 'metodo_pago' => $_SESSION['metodo_pago']]);
        die();
    }
} else {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Método de solicitud inválido (debe ser POST)']);
    die();
}
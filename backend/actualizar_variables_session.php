<?php
require "../backend/conexion.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ordenar_por'])) {
        $ordenar_por = $_POST['ordenar_por'];
        $orden_preferido = $_POST['orden_preferido'];
        $_SESSION['ordenar_por'] = $ordenar_por;
        $_SESSION['orden_preferido'] = $orden_preferido;

        echo json_encode(['estado' => 'exito', 'ordenar_por' => $_SESSION['ordenar_por'], 'orden_preferido' => $_SESSION['orden_preferido']]);
        die();
    }
    if (isset($_POST['producto_para_agregar']) && isset($_POST['cantidad'])) {
        $ID_producto = $_POST['producto_para_agregar'];
        $cantidad = $_POST['cantidad'];
        echo $ID_producto . ' ' . $cantidad;

        $instruccion = "SELECT * FROM productos WHERE ID_producto = '$ID_producto'";
        echo $instruccion;
        $resultado = mysqli_query($conn, $instruccion);

        mysqli_error($conn);

        $producto = [];
        if ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $producto['ID_producto'] = $fila['ID_producto'];
            $producto['nombre'] = $fila['nombre'];
            $producto['cantidad'] = $cantidad;
            $producto['precio'] = $fila['precio'];
        }
        mysqli_free_result($resultado);

        $_SESSION['productos_seleccionados'][] = $producto;

        echo json_encode(['estado' => 'exito', 'producto' => $producto]);
        Header('Location: ../interfaces/ingreso_ventas.php?&a=sddas');
        die();
    }
    if (isset($_POST['metodo_pago']) && isset($_POST['metodo_pago'])) {
        $metodo_pago = $_POST['metodo_pago'];
        $_SESSION['metodo_pago'] = $metodo_pago;

        echo json_encode(['estado' => 'exito', 'metodo_pago' => $_SESSION['metodo_pago']]);
        die();
    }
} else {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Método de solicitud inválido (debe ser POST)']);
    die();
}
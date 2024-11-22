<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario.php';
require '../backend/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {

        $productos = $_SESSION['productos_seleccionados'];
        if (!isset($_POST['metodos_pago']) || !is_array($_POST['metodos_pago']) || !count($_POST['metodos_pago']) > 0) {
            Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Ingrese un m&eacute;todo de pago para poder registrar su venta'));
            die();
        }
        if (!isset($_SESSION['productos_seleccionados']) || empty($_SESSION['productos_seleccionados']) || !is_array($_SESSION['productos_seleccionados'])) {
            Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Ingrese un producto para poder registrar su venta'));
            die();
        }

        $ID_usuario = (int) sanitizar($_POST['usuario']);
        $metodos_pago = $_POST['metodos_pago'];
        $cantidad_paga = $_POST['cantidades_pago'];
        for ($i = 0; $i < count($metodos_pago); $i++) {
            $pagos[] = [
                'metodo_pago' => $metodos_pago[$i],
                'cantidad_pago' => $cantidad_paga[$i]
            ];
        }

        $instruccion_venta = 'INSERT INTO ventas (ID_usuario) VALUES (' . $ID_usuario . ')';
        if (mysqli_query($conn, $instruccion_venta)) {
            $ID_venta = mysqli_insert_id($conn);

            $instruccion_metodo_pago = 'INSERT INTO venta_metodos_pago (ID_venta, ID_metodo_pago, cantidad_paga) VALUES ';
            $i=0;
            foreach($pagos as $pago) {
                $i++;
                $instruccion_metodo_pago .= '(' . $ID_venta . ', ' . $pago['metodo_pago'] . ', ' . $pago['cantidad_pago'] . ')';
                if($i != count($pagos)){
                    $instruccion_metodo_pago .= ', ';
                }
            }
            echo $instruccion_metodo_pago;
            
            $instruccion_detalles_venta = 'INSERT INTO detalles_venta (ID_venta, ID_producto, cantidad) VALUES ';
            $detalles_values = [];
            foreach($productos as $producto) {
                $detalles_values[] = '(' . $ID_venta . ', ' . $producto['ID_producto'] . ', ' . $producto['cantidad'] . ')';
            }
            $instruccion_detalles_venta .= implode(',', $detalles_values);

            if (mysqli_query($conn, $instruccion_metodo_pago) && mysqli_query($conn, $instruccion_detalles_venta)) {
                $instruccion_actualizar_stock = 'UPDATE productos p JOIN detalles_venta dv ON p.ID_producto = dv.ID_producto SET p.stock = p.stock - dv.cantidad WHERE dv.ID_venta = ' . $ID_venta;
                if (mysqli_query($conn, $instruccion_actualizar_stock)) {
                    Header('Location: ../interfaces/ingreso_ventas.php?notificacion=' . urlencode('Venta registrada exitosamente'));
                    exit();
                }
            }
        }

        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error en la inserción de datos'));
    } else {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error al procesar los datos de la venta.'));
    }
} else {
    Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Método de solicitud incorrecto.'));
}
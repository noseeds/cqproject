<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['productos']) && !empty($_POST['productos']) &&
        isset($_POST['usuario']) && !empty($_POST['usuario']) &&
        isset($_POST['metodo_pago']) && !empty($_POST['metodo_pago'])) {

        $productos = json_decode($_POST['productos'], true);
        if (!is_array($productos) || $productos == [] || json_last_error() !== JSON_ERROR_NONE) {
            Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Ingrese un producto para poder registrar su venta'));
            die();
        }

        $ID_usuario = $_POST['usuario'];
        $metodo_pago = $_POST['metodo_pago'];
        $cantidad_paga = $_POST['cantidad_paga'];

        $instruccion_venta = 'INSERT INTO ventas (ID_usuario) VALUES (' . $ID_usuario . ')';
        if (mysqli_query($conn, $instruccion_venta)) {
            $ID_venta = mysqli_insert_id($conn);

            $instruccion_metodo_pago = 'INSERT INTO venta_metodos_pago (ID_venta, ID_metodo_pago, cantidad_paga) VALUES (' . $ID_venta . ', ' . $metodo_pago . ', ' . $cantidad_paga . ')';
            
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
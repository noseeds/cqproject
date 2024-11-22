<?php
/*
    INUTILIZADO
*/
require '../backend/conexion.php';
require '../backend/comprobar_usuario_administrador.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {

        if (!isset($_POST['productos']) || empty($_POST['productos']) || !is_array($_POST['productos'])) {
            Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Ingrese un producto para poder registrar su venta'));
            die();
        } else {
            $productos_s = $_POST['productos'];
        }
        $metodos_pago = $_POST['metodos_pago'];
        $cantidades = $_POST['cantidades'];
        $indice = 0;
        foreach($productos_s as &$producto_s) {
            $producto['ID_producto'] = $producto_s;
            $producto['cantidad'] = $cantidades[$indice];
            $productos[] = $producto;
            $indice++;
        } unset($producto);


        $ID_usuario = $_POST['usuario'];
        $metodos_pago = $_POST['metodos_pago'];
        $cantidad_paga = $_POST['cantidades_pago'];
        for ($i = 0; $i < count($metodos_pago); $i++) {
            $pagos[] = [
                'metodo_pago' => $metodos_pago[$i],
                'cantidad_pago' => $cantidad_paga[$i]
            ];
        }

        if (isset($_POST['venta'])) {
            $ID_venta = $_POST['venta'];
            $instruccion_venta = 'UPDATE ventas SET ID_usuario = ' . $ID_usuario . ' WHERE ID_venta = ' . $ID_venta;
            $instruccion_detalle = 'DELETE dv, vm
            FROM detalles_venta dv
            JOIN venta_metodos_pago vm ON dv.ID_venta = vm.ID_venta
            WHERE dv.ID_venta = ' . $ID_venta;
            if (mysqli_query($conn, $instruccion_venta) && mysqli_query($conn, $instruccion_detalle)) {

                $instruccion_metodo_pago = 'INSERT INTO venta_metodos_pago (ID_venta, ID_metodo_pago, cantidad_paga) VALUES ';
                $i = 0;
                foreach ($pagos as $pago) {
                    $i++;
                    $instruccion_metodo_pago .= '(' . $ID_venta . ', ' . $pago['metodo_pago'] . ', ' . $pago['cantidad_pago'] . ')';
                    if ($i != count($pagos)) {
                        $instruccion_metodo_pago .= ', ';
                    }
                }

                $instruccion_detalles_venta = 'INSERT INTO detalles_venta (ID_venta, ID_producto, cantidad) VALUES ';
                $detalles_values = [];
                foreach ($productos as $producto) {
                    $detalles_values[] = '(' . $ID_venta . ', ' . $producto['ID_producto'] . ', ' . $producto['cantidad'] . ')';
                }
                $instruccion_detalles_venta .= implode(',', $detalles_values);

                if (mysqli_query($conn, $instruccion_metodo_pago) && mysqli_query($conn, $instruccion_detalles_venta)) {
                    $instruccion_actualizar_stock = 'UPDATE productos p JOIN detalles_venta dv ON p.ID_producto = dv.ID_producto SET p.stock = p.stock - dv.cantidad WHERE dv.ID_venta = ' . $ID_venta;
                    if (mysqli_query($conn, $instruccion_actualizar_stock)) {
                        Header('Location: ../interfaces/gestion_ventas.php?notificacion=' . urlencode('Venta registrada exitosamente'));
                        exit();
                    } else {
                        Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Error al actualizar el stock'));
                        exit();
                    }
                } else {
                    Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Error al insertar detalles de venta o métodos de pago'));
                    exit();
                }
            } else {
                Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Error en la inserción de la venta'));
                exit();
            }
        }
    } else {
        Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Error al procesar los datos de la venta.'));
    }
} else {
    Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Método de solicitud incorrecto.'));
}
?>

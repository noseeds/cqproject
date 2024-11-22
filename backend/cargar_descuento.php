<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario_administrador.php';
require '../backend/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_SESSION['productos_seleccionados']) && !empty($_SESSION['productos_seleccionados'])
    && isset($_POST['porcentaje']) && !empty($_POST['porcentaje'])
    ) {
        $productos = $_SESSION['productos_seleccionados'];
        if (is_array($productos) && $productos != [] && json_last_error() !== JSON_ERROR_NONE) {
            Header('Location: ../interfaces/ingreso_descuentos.php?advertencia=' . urlencode('Error al intentar leer los productos.'));
            die();
        }
        $porcentaje = (int) sanitizar($_POST['porcentaje']);

        $fecha_expiracion;
        if(isset($_POST['fecha_expiracion']) && !empty($_POST['fecha_expiracion'])) {
            $fecha_expiracion = $_POST['fecha_expiracion'];
            $timestamp = strtotime($fecha_expiracion);
        
            if ($timestamp !== false) {
                $fecha_formateada = date('Y-m-d', $timestamp);
                if ($fecha_formateada !== $fecha_expiracion) {
                    die('Formato de fecha no v&aacute;lido.');
                }
            } else {
                die('Fecha no v&aacute;lida.');
            }
        }

        $instruccion_descuento = 'INSERT INTO descuentos (porcentaje) VALUES (' . $porcentaje . ')';
        if($resultado = mysqli_query($conn, $instruccion_descuento)) {
            $ID_descuento = mysqli_insert_id($conn);
            $resultado = false;
            foreach($productos as $producto) {
                $instruccion_descuento_productos = 'INSERT INTO descuento_productos (ID_descuento, ID_producto) VALUES (' . $ID_descuento . ', ' . $producto['ID_producto'] . ')';
                if(!$resultado = mysqli_query($conn, $instruccion_descuento_productos)) {
                    Header('Location: ../interfaces/ingreso_descuentos.php?advertencia=' . urlencode('Error inesperado. ' . mysqli_error($conn)));
                    die();
                }
            }
            $_SESSION['productos_seleccionados'] = [];
            Header('Location: ../interfaces/ingreso_descuentos.php?notificacion=' . urlencode('Descuento ingresado con éxito. '));
        } else {
            Header('Location: ../interfaces/ingreso_descuentos.php?advertencia=' . urlencode('Error de consulta al intentar registrar el descuento. ' . mysqli_error($conn)));
        }
    } else {
        Header('Location: ../interfaces/ingreso_descuentos.php?advertencia=' . urlencode('Error al procesar los datos del descuento. '));
    }
} else {
    Header('Location: ../interfaces/ingreso_descuentos.php?advertencia=' . urlencode('Método de solicitud incorrecto. '));
}
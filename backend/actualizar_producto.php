<?php
require "../backend/conexion.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['producto']) && !empty($_SESSION['producto'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])
    && isset($_POST['descripcion']) && !empty($_POST['descripcion'])
    && isset($_POST['precio']) && !empty($_POST['precio'])
    && isset($_POST['stock']) && !empty($_POST['stock'])) {
        $ID_producto = $_SESSION['producto'];
        
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        $instruccion = 'UPDATE productos SET nombre = "' . $nombre . '", descripcion = "' . $descripcion . '", precio = ' . $precio . ', stock = ' . $stock . ' WHERE ID_producto = ' . $ID_producto;
        echo $instruccion;
        if(mysqli_query($conn, $instruccion)) {
            Header('Location: ../interfaces/modificar_producto.php?notificacion=' . urlencode('Información del producto actualizada exitosamente') . '#respuesta_servidor');
        die();
        }
    } else {
        Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error. Revise los datos ingresados y vuelva a intentar.') . '#respuesta_servidor');
        die();
    }
} else {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Método de solicitud inválido (debe ser POST).']);
    die();
}
<?php
    require '../backend/conexion.php';
    require '../headers/header_interfaces.php';

    if(isset($_GET['producto']) && !empty($_GET['producto'])) {

        $instruccion = 'DELETE FROM productos WHERE ID_producto = ' . $_GET['producto'];
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ./gestion_productos.php?notificacion=' . urlencode('Producto eliminado con &eacute;xito.'));
        } else {
            Header('Location: ./gestion_productos.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ./gestion_productos.php');
    }
?>
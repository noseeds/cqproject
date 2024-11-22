<?php
    require '../backend/conexion.php';
    require '../headers/header_interfaces.php';
    require '../backend/funciones.php';

    if(isset($_GET['producto']) && !empty($_GET['producto'])) {
        $producto = (int) sanitizar($_GET['producto']);
        $instruccion = 'UPDATE productos SET activo = 1 WHERE ID_producto = ' . $producto;
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ../interfaces/gestion_productos.php?notificacion=' . urlencode('Producto activado con &eacute;xito.'));
        } else {
            Header('Location: ../interfaces/gestion_productos.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ../interfaces/gestion_productos.php?advertencia=' . urlencode('Error de envío de datos del formulario'));
    }
?>
<?php
    require '../backend/conexion.php';
    require '../headers/header_interfaces.php';

    if(isset($_GET['usuario']) && !empty($_GET['usuario'])) {

        $instruccion = 'UPDATE usuarios SET activo = 0 WHERE ID_usuario = ' . $_GET['usuario'];
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ./gestion_usuarios.php?notificacion=' . urlencode('Usuario desactivado con &eacute;xito.'));
        } else {
            Header('Location: ./gestion_usuarios.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ./gestion_usuarios.php?advertencia=' . urlencode('Ocurri&oacute; un error inesperado.'));
    }
?>

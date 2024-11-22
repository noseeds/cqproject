<?php
    require '../backend/conexion.php';
    require '../headers/header_interfaces.php';
    require '../backend/funciones.php';

    if(isset($_GET['usuario']) && !empty($_GET['usuario'])) {
        $usuario = (int) sanitizar($_GET['usuario']);
        $instruccion = 'UPDATE usuarios SET activo = 1 WHERE ID_usuario = ' . $usuario;
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ../interfaces/gestion_usuarios.php?notificacion=' . urlencode('Usuario activado con &eacute;xito.'));
        } else {
            Header('Location: ../interfaces/gestion_usuarios.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ../interfaces/gestion_usuarios.php?advertencia=' . urlencode('Ocurri&oacute; un error inesperado.'));
    }
?>

<?php
    require '../backend/conexion.php';
    require '../headers/header_interfaces.php';

    if(isset($_GET['gasto']) && !empty($_GET['gasto'])) {
        $_SESSION['gasto'] = $_GET['gasto'];
    }

    if(isset($_SESSION['gasto']) && !empty($_SESSION['gasto']) && $_SESSION['gasto'] != 0) {

        $instruccion = 'DELETE FROM gastos WHERE ID_gasto = ' . $_SESSION['gasto'];
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ../interfaces/gestion_gastos.php?notificacion=' . urlencode('Registro de egreso eliminado con &eacute;xito.') . '&consulta=' . urlencode($instruccion));
        } else {
            Header('Location: ../interfaces/gestion_gastos.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }

    } else {
        Header('Location: ../interfaces/gestion_gastos.php?advertencia=' . urlencode('Ocurri&oacute; un error inesperado.'));
    }
?>
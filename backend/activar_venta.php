<?php
    require '../backend/conexion.php';

    if(isset($_GET['venta']) && !empty($_GET['venta'])) {

        $instruccion = 'UPDATE ventas SET activo = 1 WHERE ID_venta = ' . $_GET['venta'];
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ../interfaces/gestion_ventas.php');
        } else {
            Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ../interfaces/gestion_ventas.php?advertencia=' . urlencode('Error de envío de datos del formulario'));
    }
?>
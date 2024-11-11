<?php
    require '../backend/conexion.php';

    if(isset($_GET['descuento']) && !empty($_GET['descuento'])) {

        $instruccion = 'UPDATE descuentos SET activo = 1 WHERE ID_descuento = ' . $_GET['descuento'];
        if($resultado = mysqli_query($conn, $instruccion))
        {
            Header('Location: ../interfaces/gestion_descuentos.php');
        } else {
            Header('Location: ../interfaces/gestion_descuentos.php?advertencia=' . urlencode('Ocurri&oacute; un error al ejecutar la consulta.'));
        }
    } else {
        Header('Location: ../interfaces/gestion_descuentos.php?advertencia=' . urlencode('Error de envío de datos del formulario'));
    }
?>
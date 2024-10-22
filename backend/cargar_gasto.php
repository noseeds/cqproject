<?php
require '../backend/conexion.php';
if (isset($_POST['valor']) && !empty($_POST['valor']) && $_POST['valor'] != 0
&& isset($_POST['motivo'])
&& isset($_POST['usuario']) && !empty($_POST['usuario'])) {

    $instruccion = 'INSERT INTO gastos (ID_usuario, motivo, valor) VALUES (' . $_POST['usuario'] . ', "' . $_POST['motivo'] . '", ' . $_POST['valor'] . ')';
    echo $instruccion;
    if($resultado = mysqli_query($conn, $instruccion)){
        Header('Location: ../interfaces/ingreso_gastos.php?notificacion='. urlencode('Egreso registrado con &eacute;xito'));
    } else {
        Header('Location: ../interfaces/ingreso_gastos.php?advertencia='. urlencode('Ocurrió un error, registro no concretado'));
    }
} else {
    Header('Location: ../interfaces/ingreso_gastos.php?advertencia='. urlencode('Ingrese los datos correctamente'));
}
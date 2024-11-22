<?php
require '../backend/conexion.php';
require '../backend/funciones.php';
if (isset($_POST['valor']) && !empty($_POST['valor']) && $_POST['valor'] != 0
&& isset($_POST['motivo'])
&& isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    $usuario = (int) sanitizar($_POST['usuario']);
    $valor = (int) sanitizar($_POST['valor']);
    $motivo = sanitizar($_POST['motivo']);
    $motivo = mysqli_real_escape_string($conn, $motivo);

    $instruccion = 'INSERT INTO gastos (ID_usuario, motivo, valor) VALUES (' . $usuario . ', "' . $motivo . '", ' . $valor . ')';
    echo $instruccion;
    if($resultado = mysqli_query($conn, $instruccion)){
        Header('Location: ../interfaces/ingreso_gastos.php?notificacion='. urlencode('Egreso registrado con &eacute;xito'));
    } else {
        Header('Location: ../interfaces/ingreso_gastos.php?advertencia='. urlencode('Ocurrió un error, registro no concretado'));
    }
} else {
    Header('Location: ../interfaces/ingreso_gastos.php?advertencia='. urlencode('Ingrese los datos correctamente'));
}
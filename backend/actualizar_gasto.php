<?php
require '../backend/conexion.php';
require '../backend/funciones.php';
session_start();

if (isset($_SESSION['gasto']) && !empty($_SESSION['gasto'])
&& isset($_POST['valor']) && !empty($_POST['valor']) && $_POST['valor'] != 0
&& isset($_POST['motivo'])
&& isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    $usuario = (int) sanitizar($_POST['usuario']);
    $gasto = (int) sanitizar($_POST['gasto']);
    $valor = (int) sanitizar($_POST['valor']);
    $motivo = sanitizar($_POST['motivo']);
    $motivo = mysqli_real_escape_string($conn, $motivo);

    $instruccion = "UPDATE gastos SET ID_usuario = " . $usuario . 
    ", motivo = '" . $motivo . 
    "', valor = " . $valor . 
    " WHERE ID_gasto = " . $gasto;

    echo $instruccion;
    if($resultado = mysqli_query($conn, $instruccion)){
        Header('Location: ../interfaces/modificar_gasto.php?notificacion='. urlencode('Egreso modificado con &eacute;xito'));
    } else {
        Header('Location: ../interfaces/modificar_gasto.php?advertencia='. urlencode('Ocurrió un error, registro no concretado'));
    }
} else {
    Header('Location: ../interfaces/modificar_gasto.php?advertencia='. urlencode('Ingrese los datos correctamente'));
}
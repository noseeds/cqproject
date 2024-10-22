<?php
require '../backend/conexion.php';
session_start();

if (isset($_SESSION['gasto']) && !empty($_SESSION['gasto'])
&& isset($_POST['valor']) && !empty($_POST['valor']) && $_POST['valor'] != 0
&& isset($_POST['motivo'])
&& isset($_POST['usuario']) && !empty($_POST['usuario'])) {

    $instruccion = "UPDATE gastos SET ID_usuario = " . (int)$_POST['usuario'] . 
    ", motivo = '" . addslashes($_POST['motivo']) . 
    "', valor = " . (float)$_POST['valor'] . 
    " WHERE ID_gasto = " . (int)$_SESSION['gasto'];

    echo $instruccion;
    if($resultado = mysqli_query($conn, $instruccion)){
        Header('Location: ../interfaces/modificar_gasto.php?notificacion='. urlencode('Egreso modificado con &eacute;xito'));
    } else {
        Header('Location: ../interfaces/modificar_gasto.php?advertencia='. urlencode('Ocurrió un error, registro no concretado'));
    }
} else {
    Header('Location: ../interfaces/modificar_gasto.php?advertencia='. urlencode('Ingrese los datos correctamente'));
}
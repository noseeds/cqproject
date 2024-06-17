<?php

require "conexion.php";

if(!$conn){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de conexión") . urlencode(mysqli_connect_error()) . "&formularioActual=" . urlencode("ingreso"));
    die();
}

$cedulaIngresada;
$passwordIngresada;

if (isset($_POST["lcedula"]) && !empty( $_POST["lcedula"]) ){
    $cedulaIngresada = $_POST["lcedula"];
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Cedula no ingresada") . "&formularioActual=" . urlencode("ingreso"));
    die();
}   

if (isset($_POST["lpassword"]) && !empty( $_POST["lpassword"]) ){
    $passwordIngresada = $_POST["lpassword"];
    $passwordIngresada = hash("sha256", $passwordIngresada);
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada")  . "&formularioActual=" . urlencode("ingreso"));
    die();
}

$instruccion = "SELECT * FROM usuarios WHERE cedula = '" . $cedulaIngresada . "'; ";

try {
    $resultado = mysqli_query($conn, $instruccion);
}
catch(Exception $e){
    Header('Location: ../login.php?advertencia=' . urlencode($e)  . "&formularioActual=" . urlencode("ingreso"));
    die();
}
if(!$resultado){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de consulta ") . urlencode(mysqli_error($conn)) . "&formularioActual=" . urlencode("ingreso"));
    die();
}else {
    $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    if($fila) {
        if($fila["contrasena"] === $passwordIngresada){
            Header("Location: ../aplicacion.php");
            die();
        } else{
            Header('Location: ../login.php?advertencia=' . urlencode("Datos incorrectos") . "&formularioActual=" . urlencode("ingreso"));
            die();
        }
    }
    mysqli_free_result( $resultado);
    Header('Location: ../login.php?advertencia=' . urlencode("Usuario ingresado no existe") . "&formularioActual=" . urlencode("ingreso"));
    die();
}
?>
<?php

require "conexion.php";

if(!$conn || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de conexión") . urlencode(mysqli_connect_error()) . "&formularioActual=" . urlencode("login"));
    die();
}

$nombre_ingresado;
$contrasena_ingresada;

if (isset($_POST["nombre_login"]) && !empty( $_POST["nombre_login"]) ){
    $nombre_ingresado = $_POST["nombre_login"];
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("nombre no ingresado") . "&formularioActual=" . urlencode("login"));
    die();
}   

if (isset($_POST["contrasena_login"]) && !empty( $_POST["contrasena_login"]) ){
    $contrasena_ingresada = $_POST["contrasena_login"];
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada")  . "&formularioActual=" . urlencode("login"));
    die();
}
$contrasena_ingresada = hash("sha256", $contrasena_ingresada);
$instruccion = "SELECT * FROM usuarios WHERE nombre = '" . $nombre_ingresado . "'; ";

try {
    $resultado = mysqli_query($conn, $instruccion);
}
catch(Exception $e){
    Header('Location: ../login.php?advertencia=' . urlencode($e)  . "&formularioActual=" . urlencode("login"));
    die();
}
if(!$resultado){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de consulta ") . urlencode(mysqli_error($conn)) . "&formularioActual=" . urlencode("login"));
    die();
}else {
    $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    if($fila["contrasena"] === $contrasena_ingresada){
        Header("Location: ../aplicacion.php");
        die();
    } else{
        Header('Location: ../login.php?advertencia=' . urlencode("Datos incorrectos para ".$fila["nombre"]." con contraseña: ".$fila["contrasena"]." y usted ingreso: ".$contrasena_ingresada) . "&formularioActual=" . urlencode("login"));
        die();
    }
}
?>
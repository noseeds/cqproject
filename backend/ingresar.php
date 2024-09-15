<?php
session_start();
$_SESSION["ordenar_por"]="fecha";
$_SESSION["orden_preferido"]="DESC";
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
    if($fila= mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        if($fila["contrasena"] === $contrasena_ingresada){
            $_SESSION['ID_usuario'] = $fila['ID_usuario'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['ingresado'] = true;
            Header("Location: ../aplicacion.php");
            die();
        } else{
            Header('Location: ../login.php?advertencia=' . urlencode("Datos incorrectos para ".$fila["nombre"].".")."&formularioActual=" . urlencode("login"));
            die();
        }
    } else{
        Header("Location: ../login.php?advertencia=".urlencode("No se han encontrado registros"));
        die();
    }
}
?>
<?php

//require "conexion.php";

$servername = "localhost";
$username = "root";
$password = "";
$database="petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de conexión") . urlencode(mysqli_connect_error()) . "&formularioActual=" . urlencode("login"));
    die();
}

$cedulaIngresada;
$passwdUsuario;

if (isset($_POST["lcedula"]) && !empty( $_POST["lcedula"]) ){
    $cedulaIngresada = $_POST["lcedula"];
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Cedula no ingresada") . "&formularioActual=" . urlencode("login"));
    die();
}   

if (isset($_POST["lpassword"]) && !empty( $_POST["lpassword"]) ){
    $passwdUsuario = $_POST["lpassword"];
    $passwdUsuario = hash("sha256", $passwdUsuario);
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada")  . "&formularioActual=" . urlencode("login"));
    die();
}

$instruccion = "SELECT * FROM usuarios WHERE cedula = '" . $cedulaIngresada . "'; ";

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
    if($fila) {
        if($fila["contrasena"] === $passwdUsuario){
            Header("Location: ../aplicacion.php");
            die();
        } else{
            Header('Location: ../login.php?advertencia=' . urlencode("Datos incorrectos") . "&formularioActual=" . urlencode("login"));
            die();
        }
    }
    mysqli_free_result( $resultado);
    Header('Location: ../login.php?advertencia=' . urlencode("Usuario ingresado no existe") . "&formularioActual=" . urlencode("login"));
    die();
}
?>
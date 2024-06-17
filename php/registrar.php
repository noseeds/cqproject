<?php

require "conexion.php";

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión: " . mysqli_connect_error()) . "&formularioActual=" . urlencode("registro"));
}

$cedulaIngresada; 
$passwordIngresada; 
$passwordIngresada2; 

if (isset($_POST['cedula']) && !empty($_POST['cedula'])) {
    $cedulaIngresada = $_POST['cedula'];
} else {
    Header('Location: ../login.php?advertencia=' . urlencode("Cedula no ingresada") . "&formularioActual=" . urlencode("registro"));
    die();
}

$resultado = mysqli_query($conn, "SELECT cedula FROM usuarios WHERE cedula = '" . $cedulaIngresada . "'; ");
//mysqli_query retorna FALSE si falla, pero si es exitosa, retorna un objeto de tipo mysqli_result  (resultado de la consulta en forma de tabla)
if($resultado) {
    $usuario = array();
    if($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
        if($fila['cedula'] === $cedulaIngresada){
            Header('Location: ../login.php?advertencia=' . urlencode("La cedula ingresada ya fue registrada") . "&formularioActual=" . urlencode("registro"));
            die();
        }
    }
}
mysqli_free_result($resultado);

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $passwordIngresada = $_POST['password']; 
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada") . "&formularioActual=" . urlencode("registro"));
    die();
}

if(strlen($passwordIngresada)<8){
    Header('Location: ../login.php?advertencia=' . urlencode("La contraseña debe contener por lo menos 8 carácteres") . "&formularioActual=" . urlencode("registro"));
    die();
}

if (isset($_POST['password2']) && !empty($_POST['password2'])){
    $passwordIngresada2 = $_POST['password2']; 
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Vuelva a ingresar la contraseña en el campo correspondiente") . "&formularioActual=" . urlencode("registro"));
    die();
}

if($passwordIngresada != $passwordIngresada2){
    Header('Location: ../login.php?advertencia=' . urlencode("Las contraseñas no coinciden") . "&formularioActual=" . urlencode("registro"));
    die();
}

$passwordIngresada = hash("sha256", $passwordIngresada);
$passwordIngresada2 = hash("sha256", $passwordIngresada2);
$instruccion = "INSERT INTO usuarios (cedula, contrasena) VALUES('$cedulaIngresada', '$passwordIngresada'); ";
if(mysqli_query($conn, $instruccion)){
    Header('Location: ../login.php?notificacion=' . urlencode("Usuario registrado con éxito") . "&formularioActual=" . urlencode("registro"));
    die();
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Error, vuelve a intentarlo más tarde" . urlencode(mysqli_error($conn)) . "&formularioActual=" . urlencode("registro")));
    die();
}

?>
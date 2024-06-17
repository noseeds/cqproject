<?php

//require "conexion.php";

$servername = "localhost";
$username = "root";
$password = "";
$database= "petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de conexión" . urlencode(mysqli_connect_error()) . "&formularioActual=" . urlencode("registro")));
    die();
}

$cedulaIngresada; 
$passwdUsuario; 
$passwdUsuario2; 

if (isset($_POST['cedula']) && !empty($_POST['cedula'])) {
    $cedulaIngresada = $_POST['cedula'];
} else {
    Header('Location: ../login.php?advertencia=' . urlencode("Cedula no ingresada") . "&formularioActual=" . urlencode("registro"));
    die();
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $passwdUsuario = $_POST['password']; 
    $passwdUsuario = hash("sha256", $passwdUsuario);
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada") . "&formularioActual=" . urlencode("registro"));
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

if (isset($_POST['password2']) && !empty($_POST['password2'])){
    $passwdUsuario2 = $_POST['password2'];
    $passwdUsuario2 = hash("sha256", $passwdUsuario2);  
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Vuelva a ingresar la contraseña en el campo correspondiente") . "&formularioActual=" . urlencode("registro"));
    die();
}

if($passwdUsuario != $passwdUsuario2){
    Header('Location: ../login.php?advertencia=' . urlencode("Las contraseñas no coinciden") . "&formularioActual=" . urlencode("registro"));
    die();
}

echo strlen($passwdUsuario);  
if(strlen($passwdUsuario)<8){
    Header('Location: ../login.php?advertencia=' . urlencode("La contraseña debe contener por lo menos 8 carácteres") . "&formularioActual=" . urlencode("registro"));
    die();
}
$instruccion = "INSERT INTO usuarios (cedula, contrasena) VALUES('$cedulaIngresada', '$passwdUsuario'); ";
if(mysqli_query($conn, $instruccion)){
    Header('Location: ../login.php?notificacion=' . urlencode("Usuario registrado con éxito") . "&formularioActual=" . urlencode("registro"));
    die();
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Error, vuelve a intentarlo más tarde" . urlencode(mysqli_error($conn)) . "&formularioActual=" . urlencode("registro")));
    die();
}

/*    $tabla = array();
    //fetch_row devuelve la primer fila y la descarta, y si no hay filas devuelve null
    $fila = mysqli_fetch_row($resultado);
    while ($fila) { 
        $tabla[] = $fila;
        $fila = mysqli_fetch_row($resultado);
    }
    mysqli_free($resultado);
*/

?>
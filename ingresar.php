<?php
/*$servername = "localhost";
$username = "id22159078_usuario";
$password = "Banana1*";
$database="id22159078_petsmimos";
$cedulaIngresada;
$passwdUsuario;*/
$servername = "localhost";
$username = "root";
$password = "";
$database="petsmimos";
$cedulaIngresada;
$passwdUsuario;

if (isset($_POST["lcedula"]) && !empty( $_POST["lcedula"]) ){
    $cedulaIngresada = $_POST["lcedula"];
}else{
    Header('Location: login.php?advertencia=' . urlencode("Cedula no ingresada"));
    die();
}   

if (isset($_POST["lpassword"]) && !empty( $_POST["lpassword"]) ){
    $passwdUsuario = $_POST["lpassword"];
}else{
    Header('Location: login.php?advertencia=' . urlencode("Contraseña no ingresada"));
    die();
}

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión" . mysqli_connect_error()));
}

$instruccion = "SELECT * FROM usuarios WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";

try {
    $resultado = mysqli_query($conn, $instruccion);
}
catch(Exception $e){
    Header('Location: login.php?advertencia=' . urlencode("a".$e));
    die();
}
if(!$resultado){
    Header('Location: login.php?advertencia=' . urlencode("Error de consulta " . mysqli_error($conn)));
    die();
}else {
    $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    if($fila) {
        $usuarios[] = $fila;
        if($usuarios[0] && $fila["Contraseña"] === $passwdUsuario){
            Header("Location: ./aplicacion.php");
            die();
        } else{
            Header('Location: login.php?advertencia=' . urlencode("Datos incorrectos"));
            die();
        }
    }
    mysqli_free_result( $resultado);
    Header('Location: login.php?advertencia=' . urlencode("Usuario ingresado no existe"));
    die();
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="petsmimos";
$cedulaIngresada;
$passwdUsuario;

if (isset($_POST["lcedula"]) && !empty( $_POST["lcedula"]) ){
    $cedulaIngresada = $_POST['lcedula'];
}else{
die('Cedula no ingresada');
}   

if (isset($_POST["lpassword"]) && !empty( $_POST["lpassword"]) ){
    $passwdUsuario = $_POST['lpassword'];
}else{
die('Contraseña no ingresada');
}   

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Error de conexión " . mysqli_connect_error());
}

$instruccion = "SELECT * FROM usuarios WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";

try {
    $resultado = mysqli_query($conn, $instruccion);
}
catch(Exception $e){
    echo "a".$e;
}
if(!$resultado){
    die("Error de consulta " . mysqli_error($conn));
}else {
    $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    while ($fila) {
        $usuarios[] = $fila;
        if($usuarios[0] && $fila['Contraseña'] === $passwdUsuario){
            Header('Location: ./aplicacion.php');
            die();
        } else{
            die("Datos incorrectos");
        }
        $fila = mysqli_fetch_array($resultado, MYSQLI_BOTH);
    }
    mysqli_free_result( $resultado);
    die("Usuario ingresado no existe");
}
?>
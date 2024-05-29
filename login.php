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

$instruccion = "SELECT cedula_usuario FROM usuario WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";
$resultado = mysqli_query($conn, $instruccion);

if(!$resultado){
    die("Error de consulta " . mysqli_error($conn));
}else {
   $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    while ($fila) {
        $usuarios[] = $fila;
        $fila = mysqli_fetch_array($resultado, MYSQLI_BOTH);
        if($usuarios[0]){
            echo("<script type='text/javascript'>
                $('#login_registro').css('display', 'none');
            }
            </script>");
        }else{
            die("Usuario ingresado no existe");
        }
    }
}
mysqli_free_result( $resultado );
$instruccion = ""
?>
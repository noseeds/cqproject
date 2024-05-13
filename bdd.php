<?php
$servername = "localhost";
$username = "id22159078_usuario";
$password = "#Banana1";
$database = "id22159078_petsmimos";
$cedulaIngresada;
if (isset($_POST['cedula'])) {
    $cedulaIngresada = $_POST['cedula'];
} else {
    die("error a ");
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$instruccion = "SELECT cedula_usuario FROM usuario WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";
$resultado = mysqli_query($conn, $instruccion);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
}

//help
echo "";
?>
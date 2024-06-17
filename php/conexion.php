<?php

$servername = "localhost";
$username = "id22159078_usuario";
$password = "Banana1*";
$database="id22159078_petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión" . mysqli_connect_error()));
}


/*$servername = "localhost";
$username = "root";
$password = "";
$database="petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión" . mysqli_connect_error()));
}


*/



?>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database='petsmimos';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode('Error de conexión. ' . mysqli_connect_error()));
}

if (!mysqli_set_charset($conn, 'utf8mb4')) {
    Header('Location: login.php?advertencia=' . urlencode('Error inesperado al intentar establecer el charset'));
}
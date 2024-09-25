<?php
/*
$servername = 'sql106.infinityfree.com';
$username = 'if0_36975679';
$password = 'bAnAnAXd112';
$database='if0_36975679_petsmimos';

$conn = mysqli_connect($servername, $username, $password, $database);
$conn->set_charset('utf8mb4');
if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode('Error de conexión' . mysqli_connect_error()));
}
*/
$servername = 'localhost';
$username = 'root';
$password = '';
$database='petsmimos';

$conn = mysqli_connect($servername, $username, $password, $database);
$conn->set_charset('utf8mb4');

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode('Error de conexión' . mysqli_connect_error()));
}
<?php

$servername = "sql106.infinityfree.com";
$username = "if0_36975679";
$password = "dOmInIqUe112";
$database="if0_36975679_petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión" . mysqli_connect_error()));
}

/*
$servername = "localhost";
$username = "root";
$password = "";
$database="petsmimos";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    Header('Location: login.php?advertencia=' . urlencode("Error de conexión" . mysqli_connect_error()));
}*/






?>
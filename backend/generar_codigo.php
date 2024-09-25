<?php
require "../backend/conexion.php";
$codigo = hash("sha256", mt_rand(1000, 9999));
$resultado = mysqli_query($conn, "INSERT INTO codigos_acceso VALUES ('$codigo', DATE_ADD(CURDATE(), INTERVAL 1 DAY));");
$url = '../registro.php?codigo_acceso='.$codigo.'&notificacion='.urlencode('Codigo de acceso ingresado, ahora podés registrarte libremente.').'&formulario_actual=registro';
echo '<a href="'.$url.'">enlace para registrarse</a>';
?>
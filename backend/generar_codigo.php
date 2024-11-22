<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario_administrador.php';
require '../backend/funciones.php';

$codigo = hash("sha256", mt_rand(1000, 9999));
$ID_usuario = (int) sanitizar($_POST['usuario']);
$instruccion = 'INSERT INTO codigos_acceso VALUES ("' . $codigo . '", "' . $ID_usuario . '", DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 1 DAY))';

$resultado = mysqli_query($conn, $instruccion);
$dominio = $_SERVER['HTTP_HOST'];
$url = $dominio . '/registro.php?codigo_acceso=' . $codigo . '&notificacion='.urlencode('Codigo de acceso ingresado, ahora podés registrarte libremente.').'&formulario_actual=registro';
echo '<input id="url" type="hidden" value="' . $url . '">';
?>
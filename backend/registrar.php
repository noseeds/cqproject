<?php

require 'conexion.php';
session_start();

if(!$conn){
    Header('Location: ../login.php?advertencia=' . urlencode('Error de conexión' . urlencode(mysqli_connect_error())));
    die();
}
if(!isset($_SESSION['codigo_acceso']) || empty($_SESSION['codigo_acceso'])) {
    Header('Location: ../login.php?advertencia=' . urlencode('Solicite un enlace de acceso al administrador para poder acceder al apartado de registro.'));
    die();
}
$codigo = $_SESSION['codigo_acceso'];

$nombre_ingresado; 
$contrasena_ingresada; 
$contrasena_ingresada2; 

if (isset($_POST['nombre_registro']) && !empty($_POST['nombre_registro'])) {
    $nombre_ingresado = mysqli_real_escape_string($conn, $_POST['nombre_registro']);
    $patron = '/^[a-zA-Z0-9_.]{3,16}$/';
    if (!preg_match($patron, $nombre_ingresado)) {
        Header('Location: ../registro.php?advertencia=' . urlencode('El nombre solo puede contener letras y números, y debe tener entre 3 y 16 carácteres') . '&formulario_actual=' . urlencode('registro'));
        die();
    }
} else {
    Header('Location: ../registro.php?advertencia=' . urlencode('nombre no ingresado') . '&formulario_actual=' . urlencode('registro'));
    die();
}
if (isset($_POST['contrasena_registro']) && !empty($_POST['contrasena_registro'])) {
    $contrasena_ingresada = mysqli_real_escape_string($conn, $_POST['contrasena_registro']);
    $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/';

    if (!preg_match($patron, $contrasena_ingresada)) {
        Header('Location: ../registro.php?advertencia=' . urlencode('La contraseña debe contener por lo menos: -una letra en minúscula. -una letra en mayúscula. -un número. -un carácter especial (@$!%*?&). -entre 8 y 32 carácteres en total.') . '&formulario_actual=' . urlencode('registro'));
        die();
    }
}else{
    Header('Location: ../registro.php?advertencia=' . urlencode('Contraseña no ingresada') . '&formulario_actual=' . urlencode('registro'));
    die();
}

$resultado = mysqli_query($conn, "SELECT nombre FROM usuarios WHERE nombre = '" . $nombre_ingresado . "'; ");
//mysqli_query retorna FALSE si falla, pero si es exitosa, retorna un objeto de tipo mysqli_result  (resultado de la consulta en forma de tabla)
if($resultado) {
    if(mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_array($resultado, MYSQLI_BOTH);
        if($fila['nombre'] === $nombre_ingresado){
            Header('Location: ../registro.php?advertencia=' . urlencode("El nombre ingresado ya fue registrado") . "&formulario_actual=" . urlencode("registro"));
            die();
        }
    } // Alternativamente podría usar if($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)). en caso de que no se obtenga una fila es porque no hay coincidencias y el nombre ingresado está disponible.
} else {
    Header('Location: ../registro.php?advertencia=' . urlencode('Error de consulta.'));
    die();
}
mysqli_free_result($resultado);

if (isset($_POST['contrasena_registro2']) && !empty($_POST['contrasena_registro2'])){
    $contrasena_ingresada2 = mysqli_real_escape_string($conn, $_POST['contrasena_registro2']);
} else{
    Header('Location: ../registro.php?advertencia=' . urlencode('Vuelva a ingresar la contraseña en el campo correspondiente') . '&formulario_actual=' . urlencode('registro'));
    die();
}
 
if(strlen($contrasena_ingresada)<8){
    Header('Location: ../registro.php?advertencia=' . urlencode('La contraseña debe contener por lo menos 8 carácteres') . '&formulario_actual=' . urlencode('registro'));
    die();
}
if($contrasena_ingresada != $contrasena_ingresada2){
    Header('Location: ../registro.php?advertencia=' . urlencode('Las contraseñas no coinciden') . '&formulario_actual=' . urlencode('registro'));
    die();
}
$instruccion = 'DELETE FROM codigos_acceso WHERE codigo = "' . $codigo . '"';
if(!$resultado = mysqli_query($conn, $instruccion) || mysqli_num_rows($resultado) < 1) {
    Header('Location: ../login.php?advertencia=' . urlencode('Ha ocurrido un error potencialmente peligroso, contacte a soporte. ' . mysqli_error($conn)));
    die();
}
$contrasena_ingresada = hash('sha256', $contrasena_ingresada);
$instruccion = "INSERT INTO usuarios (nombre, contrasena, tipo) VALUES('$nombre_ingresado', '$contrasena_ingresada', 'común'); ";
if(mysqli_query($conn, $instruccion)){
    Header('Location: ../login.php?notificacion=' . urlencode('Usuario registrado con éxito') . '&formulario_actual=' . urlencode('registro'));
    die();
} else{
    Header('Location: ../registro.php?advertencia=' . urlencode('Error, vuelve a intentarlo más tarde' . urlencode(mysqli_error($conn)) . '&formulario_actual=' . urlencode('registro')));
    die();
}

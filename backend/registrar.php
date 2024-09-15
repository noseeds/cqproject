<?php

require "conexion.php";

if(!$conn || $_SERVER['REQUEST_METHOD'] !== 'POST'){
    Header('Location: ../login.php?advertencia=' . urlencode("Error de conexión" . urlencode(mysqli_connect_error()) . "&formularioActual=" . urlencode("registro")));
    die();
}

$nombre_ingresado; 
$contrasena_ingresada; 
$contrasena_ingresada2; 

if (isset($_POST['nombre_registro']) && !empty($_POST['nombre_registro'])) {
    $nombre_ingresado = $_POST['nombre_registro'];
} else {
    Header('Location: ../login.php?advertencia=' . urlencode("nombre no ingresada") . "&formularioActual=" . urlencode("registro"));
    die();
}
if (isset($_POST['contrasena_registro']) && !empty($_POST['contrasena_registro'])) {
    $contrasena_ingresada = $_POST['contrasena_registro'];
}else{
    Header('Location: ../login.php?advertencia=' . urlencode("Contraseña no ingresada") . "&formularioActual=" . urlencode("registro"));
    die();
}

$resultado = mysqli_query($conn, "SELECT nombre FROM usuarios WHERE nombre = '" . $nombre_ingresado . "'; ");
//mysqli_query retorna FALSE si falla, pero si es exitosa, retorna un objeto de tipo mysqli_result  (resultado de la consulta en forma de tabla)
if($resultado) {
    $usuario = array();
    if($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
        if($fila['nombre'] === $nombre_ingresado){
            Header('Location: ../login.php?advertencia=' . urlencode("El nombre ingresado ya fue registrado") . "&formularioActual=" . urlencode("registro"));
            die();
        }
    }
}
mysqli_free_result($resultado);

if (isset($_POST['contrasena_registro2']) && !empty($_POST['contrasena_registro2'])){
    $contrasena_ingresada2 = $_POST['contrasena_registro2'];
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Vuelva a ingresar la contraseña en el campo correspondiente") . "&formularioActual=" . urlencode("registro"));
    die();
}

echo strlen($contrasena_ingresada);  
if(strlen($contrasena_ingresada)<8){
    Header('Location: ../login.php?advertencia=' . urlencode("La contraseña debe contener por lo menos 8 carácteres") . "&formularioActual=" . urlencode("registro"));
    die();
}
if($contrasena_ingresada != $contrasena_ingresada2){
    Header('Location: ../login.php?advertencia=' . urlencode("Las contraseñas no coinciden") . "&formularioActual=" . urlencode("registro"));
    die();
}
$contrasena_ingresada = hash("sha256", $contrasena_ingresada);
$instruccion = "INSERT INTO usuarios (nombre, contrasena) VALUES('$nombre_ingresado', '$contrasena_ingresada'); ";
if(mysqli_query($conn, $instruccion)){
    Header('Location: ../login.php?notificacion=' . urlencode("Usuario registrado con éxito") . "&formularioActual=" . urlencode("registro"));
    die();
} else{
    Header('Location: ../login.php?advertencia=' . urlencode("Error, vuelve a intentarlo más tarde" . urlencode(mysqli_error($conn)) . "&formularioActual=" . urlencode("registro")));
    die();
}

/*    $tabla = array();
    //fetch_row devuelve la primer fila y la descarta, y si no hay filas devuelve null
    $fila = mysqli_fetch_row($resultado);
    while ($fila) { 
        $tabla[] = $fila;
        $fila = mysqli_fetch_row($resultado);
    }
    mysqli_free($resultado);
*/

?>
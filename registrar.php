<?php
/* $servername = "localhost";
$username = "id22159078_usuario";
$password = "#Banana1";
$database = "id22159078_petsmimos";
$cedulaIngresada; */

$servername = "localhost";
$username = "root";
$password = "";
$database = "petsmimos";
$cedulaIngresada;
$passwdUsuario;
$passwdUsuario2;


if (isset($_POST['cedula']) && !empty($_POST['cedula'])) {
    $cedulaIngresada = $_POST['cedula'];
} else {
    die("Cedula no ingresada");
}
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $passwdUsuario = $_POST['password']; 
}else{
    die('Contraseña no ingresada');
}

if (isset($_POST['password2']) && !empty($_POST['password2'])){
    $passwdUsuario2 = $_POST['password2']; 
} else{
    die('Vuelva a ingresar la contraseña en el campo correspondiente');
}

if($passwdUsuario != $passwdUsuario2){
    die('Las contraseñas no coinciden');
}

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$instruccion = "SELECT cedula_usuario FROM usuarios WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";
$resultado = mysqli_query($conn, $instruccion); //mysqli_query retorna FALSE si falla, pero si es exitosa, retorna un objeto de tipo mysqli_result

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
} else if($resultado && strlen($passwdUsuario)==8) {
    $usuarios = array();
    $fila= mysqli_fetch_array($resultado, MYSQLI_BOTH);
    while ($fila) {
        $usuarios[] = $fila;
        $fila = mysqli_fetch_array($resultado, MYSQLI_BOTH); //
        if($usuarios[0]){
            die("La cedula ingresada ya fue registrada");
        }
    }
    mysqli_free_result($resultado);
    $instruccion = "INSERT INTO usuarios (cedula_usuario, contraseña) VALUES('$cedulaIngresada', '$passwdUsuario'); ";
    if($conn->query($instruccion)){
        echo "<label style='color: rgba(0,0,255,0.8);'> Usuario registrado con éxito </label>";
        die();
    } else{
        echo "Error, vuelve a intentarlo más tarde. ". mysqli_error($conn);
    }
    mysqli_free_result($resultado);
} else if(!strlen($passwdUsuario)==8){
    
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
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
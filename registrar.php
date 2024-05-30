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

echo '<pre>';
print_r($_POST);
echo '</pre>';
if (isset($_POST['cedula'])) {
    $cedulaIngresada = $_POST['cedula'];
} else {
    die("Cedula no ingresada");
}

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$instruccion = "SELECT cedula_usuario FROM usuario WHERE cedula_usuario = '" . $cedulaIngresada . "'; ";
$resultado = mysqli_query($conn, $instruccion); //mysqli_query retorna FALSE si falla, pero si es exitosa, retorna un objeto de tipo mysqli_result

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conn));
} else if($resultado) {
    $usuarios = array();
    //fetch_row devuelve la primer fila y la descarta, y si no hay filas devuelve null
    while ($fila=mysqli_fetch_array($resultado, MYSQLI_BOTH)) { 
        $usuarios[] = $fila;
        $fila = mysqli_fetch_array($resultado, MYSQLI_BOTH);
        echo "a";
        if($usuarios[0]){
            echo "<p class='echo'> la cedula ingresada ya fue registrada </p>"; 
            die("pitoco");
        } else{
        
        }
    } 
    mysqli_free_result($resultado);
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
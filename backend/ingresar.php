<?php
session_start();
$_SESSION['ordenar_por'] = 'fecha';
$_SESSION['orden_preferido'] = 'DESC';
require 'conexion.php';

if (!$conn || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    Header('Location: ../login.php?advertencia=' . urlencode('Error de conexión. ' . mysqli_connect_error()) . '&formulario_actual=' . urlencode('login'));
    die();
}

$nombre_ingresado;
$contrasena_ingresada;

if (isset($_POST['nombre_login']) && !empty($_POST['nombre_login'])) {
    $nombre_ingresado = $_POST['nombre_login'];
} else {
    Header('Location: ../login.php?advertencia=' . urlencode('nombre no ingresado') . '&formulario_actual=' . urlencode('login'));
    die();
}

if (isset($_POST['contrasena_login']) && !empty($_POST['contrasena_login'])) {
    $contrasena_ingresada = $_POST['contrasena_login'];
} else {
    Header('Location: ../login.php?advertencia=' . urlencode('Contraseña no ingresada') . '&formulario_actual=' . urlencode('login'));
    die();
}
$contrasena_ingresada = hash('sha256', $contrasena_ingresada);
$instruccion = 'SELECT * FROM usuarios WHERE nombre = "' . $nombre_ingresado . '"; ';

try {
    $resultado = mysqli_query($conn, $instruccion);
} catch (Exception $e) {
    Header('Location: ../login.php?advertencia=' . urlencode($e) . '&formulario_actual=' . urlencode('login'));
    die();
}
if (!$resultado) {
    Header('Location: ../login.php?advertencia=' . urlencode('Error de consulta ' . mysqli_error($conn)) . '&formulario_actual=' . urlencode('login'));
    die();
} else {
    if ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        if ($fila['contrasena'] === $contrasena_ingresada) {
            if($fila['activo'] != 0) {
                $_SESSION['ID_usuario'] = $fila['ID_usuario'];
                $_SESSION['nombre_usuario'] = $fila['nombre'];
                $_SESSION['ingresado'] = true;
                $_SESSION['tipo_usuario'] = $fila['tipo'];
                if($fila['tipo'] === 'administrador'){
                    Header('Location: ../menu_admin.php');
                } else {
                    Header('Location: ../menu.php');
                }
                die();
            } else {
                Header('Location: ../login.php?advertencia=' . urlencode('El usuario ' . $fila['ID_usuario'] . ' se encuentra inactivo, por lo que no podrá ser utilizado para ingresar a la aplicación. Solo un administrador es capaz de volver a activarlo'));
            }
        } else {
            Header('Location: ../login.php?advertencia=' . urlencode('Datos incorrectos para ' . $fila['nombre'] . '.') . '&formulario_actual=' . urlencode('login'));
            die();
        }
    } else {
        Header('Location: ../login.php?advertencia=' . urlencode('El nombre de usuario ingresado no existe'));
        die();
    }
}
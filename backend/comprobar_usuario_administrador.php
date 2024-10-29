<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['ingresado'] != TRUE) {
    Header('Location: ../login.php?advertencia=' . urlencode('Debe ingresar para poder acceder a las funciones de la aplicación'));
}
if ($_SESSION['tipo_usuario'] !== 'administrador') {
    Header('Location: ../menu.php?advertencia=' . urlencode('Usted no dispone de los permisos necesarios para acceder a esta función'));
}
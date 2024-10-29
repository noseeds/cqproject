<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['productos_seleccionados'] = [];
$_SESSION['ordenar_por'] = '';
?>
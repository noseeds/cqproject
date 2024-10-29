<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['ingresado'] != true) {
        Header("Location: login.php");
    }
    require './backend/conexion.php';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Mimos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script type="application/javascript" src="js/aplicacion.js"></script>
    <link rel="stylesheet" href="css/aplicacion.css">
    <!-- <script src="https://kit.fontawesome.com/c3da410f5c.js" crossorigin="anonymous"></script> -->
</head>

<body class="noseleccionable">
    <header>
        <nav>
            <a href="menu.php" class="nav_item"><img src="iconos/menu.svg" class="nav_icon"></a>
            <a href="interfaces/transacciones.php" class="nav_item"><img src="iconos/funds-fill.svg"
                    class="nav_icon"></a>
            <a href="catalogo.php" class="nav_item"><img src="iconos/store-3-fill.svg" class="nav_icon"></a>
            <a href="login.php" class="nav_item"><img src="iconos/account-circle-fill.svg" class="nav_icon"></a>
            <a id='mostrar_alertas_restock' class="nav_item"> <img src="iconos/notification-fill.svg" class="nav_icon"
                    alt="alertas de restock"> </a>
        </nav>
<?php
include './interfaces/alertas_restock.php';
?>
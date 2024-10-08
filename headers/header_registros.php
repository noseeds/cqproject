<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        session_start();
        if($_SESSION['ingresado'] != true){
            Header("Location: ../login.php");
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Mimos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script type="application/javascript" src="../js/aplicacion.js"></script>
    <link rel="stylesheet" href="../css/aplicacion.css" >
    <!-- <script src="https://kit.fontawesome.com/c3da410f5c.js" crossorigin="anonymous"></script> -->
</head>
<body class="noseleccionable">
    <header>
        <nav>
            <a class="nav_item"><img src="img/logo_oscuro.svg" class="nav_icon" alt="logo Pets Mimos"></a>
            <a class="nav_item"><img src="../iconos/menu.svg" class="nav_icon"></a>   
            <a class="nav_item"><img src="../iconos/bar-chart-2.svg" class="nav_icon"></a>
            <a href="login.php" class="nav_item"><img src="../iconos/account-circle.svg" class="nav_icon"></a>
            <a href="inicio.php" class="nav_item" ><img src="../iconos/add-circle.svg" class="nav_icon"></a>
        </nav>
    </header>
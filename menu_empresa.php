<?php
require 'headers/header_menu.php';
require 'backend/comprobar_usuario.php';
include 'backend/limpiar_session.php';
?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>

<h1> Menu Empresa</h1>
<article>
    <h2> Ingresar...</h2>
    <div class='menu_div'>
        <a href='interfaces/ingreso_ventas.php'>
            <img src='./iconos/shopping-basket-2-fill.svg' alt=''>
            <label> Venta</label>
        </a>
        <a href='interfaces/ingreso_gastos.php'>
            <img src='./iconos/receipt-fill.svg' alt=''>
            <label> Egreso</label>
        </a>
        <?php
        if($_SESSION['tipo_usuario'] === 'administrador') {
            echo '
        <a href="./interfaces/ingreso_descuentos.php">
            <img src="./iconos/discount-percent-fill.svg" alt="">
            <label> Descuento</label>
        </a>
            ';
        }
    ?>
    </div>
    <?php
        if($_SESSION['tipo_usuario'] === 'administrador') {
            echo '
    <hr>
    <h2> Modificar...</h2>
    <div class="menu_div">
        <a href="interfaces/gestion_ventas.php">
            <img src="./iconos/line/shopping-basket-2-line.svg" alt="">
            <label> Ventas registradas</label>
        </a>
        <a href="interfaces/gestion_gastos.php">
            <img src="./iconos/line/receipt-line.svg" alt="">
            <label> Egresos</label>
        </a>
        <a href="interfaces/gestion_descuentos.php">
            <img src="./iconos/line/discount-percent-line.svg" alt="">
            <label> Descuentos</label>
        </a>
    </div>';
    }
    ?>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='./menu_admin.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>

</body>

</html>
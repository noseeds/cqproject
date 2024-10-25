<?php
require 'headers/header_menu.php';
include 'backend/limpiar_session.php';
?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>

<h1> Menu</h1>
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
    </div>
    <hr>
    <h2> Modificar...</h2>
    <div class='menu_div'>
        <a href='interfaces/gestion_ventas.php'>
            <img src='./iconos/file-list-3-fill.svg' alt=''>
            <label> Ventas registradas</label>
        </a>
        <a href='interfaces/gestion_gastos.php'>
            <img src='./iconos/receipt-fill.svg' alt=''>
            <label> Egresos</label>
        </a>
    </div>
</article>

</body>

</html>
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
        <a href='interfaces/ingreso_productos.php'>
            <img src='./iconos/price-tag-3-fill.svg' alt=''>
            <label> Nuevo producto</label>
        </a>
        <a href='interfaces/ingreso_ventas.php'>
            <img src='./iconos/shopping-basket-2-fill.svg' alt=''>
            <label> Venta</label>
        </a>
        <a href='interfaces/ingreso_gastos.php'>
            <img src='./iconos/receipt-fill.svg' alt=''>
            <label> Egreso</label>
        </a>
        <a href='interfaces/ingreso_descuentos.php'>
            <img src='./iconos/discount-percent-fill.svg' alt=''>
            <label> Descuento</label>
        </a>
        <a href='interfaces/nuevo_usuario.php'>
            <img src='./iconos/user-add-fill.svg' alt=''>
            <label> Nuevo usuario</label>
        </a>
    </div>
    <hr>
    <h2> Modificar...</h2>
    <div class='menu_div'>
        <a href='interfaces/gestion_productos.php'>
            <img src='./iconos/pencil-fill.svg' alt=''>
            <label> Catálogo de Productos</label>
        </a>
        <a href='interfaces/gestion_ventas.php'>
            <img src='./iconos/file-list-3-fill.svg' alt=''>
            <label> Ventas registradas</label>
        </a>
        <a href='interfaces/gestion_gastos.php'>
            <img src='./iconos/receipt-fill.svg' alt=''>
            <label> Egresos</label>
        </a>
        <a href='interfaces/gestion_egresos.php'>
            <img src='./iconos/shopping-bag.svg' alt=''>
            <label> Descuentos</label>
        </a>
        <a href='interfaces/gestion_usuarios.php'>
            <img src='./iconos/id-card-fill.svg' alt=''>
            <label> Usuarios</label>
        </a>
    </div>
</article>

</body>

</html>
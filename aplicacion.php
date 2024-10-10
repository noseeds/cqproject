<?php
require 'headers/header.php';
include 'backend/limpiar_session.php';
?>
</header>

<h1> Menu</h1>
<article>
    <h2> Ingresar...</h2>
    <div class='menu_div'>
        <a href='interfaces/ingreso_productos.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Nuevo producto</label>
        </a>
        <a href='interfaces/ingreso_ventas.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Venta</label>
        </a>
        <a href='interfaces/ingreso_gastos.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Egreso</label>
        </a>
        <a href='interfaces/nuevo_usuario.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Nuevo usuario</label>
        </a>
    </div>
    <hr>
    <h2> Modificar...</h2>
    <div class='menu_div'>
        <a href='interfaces/gestion_productos.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Catálogo de Productos</label>
        </a>
        <a href='interfaces/gestion_ventas.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Ventas registradas</label>
        </a>
        <a href='interfaces/gestion_egresos.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Egresos</label>
        </a>
        <a href='interfaces/gestion_usuarios.php'>
            <img src='./iconos/add-circle.svg' alt=''>
            <label> Usuarios</label>
        </a>
    </div>
</article>

</body>

</html>
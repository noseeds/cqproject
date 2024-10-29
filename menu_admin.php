<?php
require 'headers/header_menu.php';
require 'backend/comprobar_usuario.php';
if($_SESSION['tipo_usuario'] !== 'administrador') {
    header('Location: ./menu.php');
}
include 'backend/limpiar_session.php';
?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>

<h1> Menu</h1>
<article>
    <h2> Bienvenido</h2>
    <div class='menu_div'>
        <a href='./menu_empresa.php'>
            <img src='./iconos/price-tag-3-fill.svg' alt=''>
            <label> Transacciones y descuentos</label>
        </a>
        <a href='./menu_catalogo.php'>
            <img src='./iconos/shopping-basket-2-fill.svg' alt=''>
            <label> Art&iacute;culos</label>
        </a>
        <a href='./menu_usuarios.php'>
            <img src='./iconos/id-card-fill.svg' alt=''>
            <label> Usuarios</label>
        </a>
        <a href='./backend/cerrar_sesion.php'>
            <img src='./iconos/logout-box-fill.svg' alt=''>
            <label> Salir</label>
        </a>
        </div>
</article>

</body>

</html>
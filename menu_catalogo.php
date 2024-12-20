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

<h1> Menu Cat&aacute;logo</h1>
<article>
    <h2> Opciones...</h2>
    <div class='menu_div'>
        <a href='./interfaces/ingreso_productos.php'>
            <img src='./iconos/price-tag-3-fill.svg' alt=''>
            <label> Nuevo producto</label>
        </a>
        <a href="interfaces/gestion_productos.php">
            <img src="./iconos/pencil-fill.svg" alt="">
            <label> Catálogo de Productos</label>
        </a>
    </div>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='./menu_admin.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>

</body>

</html>
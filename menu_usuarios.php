<?php
require 'headers/header_menu.php';
require 'backend/comprobar_usuario_administrador.php';
include 'backend/limpiar_session.php';
?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>

<h1> Menu</h1>
<article>
    <h2> Opciones...</h2>
    <div class='menu_div'>
        <a href='interfaces/nuevo_usuario.php'>
            <img src='./iconos/user-add-fill.svg' alt=''>
            <label> Nuevo usuario</label>
        </a>
        <a href='interfaces/gestion_usuarios.php'>
            <img src='./iconos/id-card-fill.svg' alt=''>
            <label> Gestionar Usuarios</label>
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
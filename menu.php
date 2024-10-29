<?php
    require 'headers/header_menu.php';
    require 'backend/comprobar_usuario.php';

    if($_SESSION['tipo_usuario'] === 'administrador')
    {
        Header('Location: ./menu_admin.php');
    }
    include 'backend/limpiar_session.php';

?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>

<h1> Bienvenido</h1>
<article>
    <h2> Menu...</h2>
    
    <div class='menu_div'>
        <a href='./menu_empresa.php'>
            <img src='./iconos/price-tag-3-fill.svg' alt=''>
            <label> Ventas & Egresos</label>
        </a>
        <a href='./menu_catalogo.php'>
            <img src='./iconos/shopping-basket-2-fill.svg' alt=''>
            <label> Art&iacute;culos</label>
        </a>
        <a href='./backend/cerrar_sesion.php'>
            <img src='./iconos/logout-box-fill.svg' alt=''>
            <label> Salir</label>
        </a>
    </div>
    <?php
        echo '<label id="respuesta_servidor"';
        if(isset($_GET['notificacion'])){
            echo ' class="notificacion">';
            echo $_GET['notificacion'];
        } else if(isset($_GET['advertencia'])){
            echo ' class="advertencia">';
            echo $_GET['advertencia'];
        }
        echo '</label>';
    ?>
</article>

</body>

</html>
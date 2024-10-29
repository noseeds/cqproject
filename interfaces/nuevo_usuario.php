<?php
    require '../backend/comprobar_usuario_administrador.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Generar Enlace de Registro de Usuario</h1>
<article>
    <p> Tenga en cuenta que...</p>
    <li> Esta sección permite generar enlaces que permitirán el registro como usuario administrador a quien lo posea y acceda a él. </li>
    <li> Éste es un enlace de uso único y los permisos otorgados son limitados en comparación con aquellos que posee el propietario (usted).</li>
    <li> Ésta interfaz es de uso y acceso exclusivo para el usuario propietario.</li>
    <form id='formulario_codigo' action='../backend/generar_codigo.php' method='POST'>
        <?php
            echo "<input type='hidden' name='productos' value='";
            echo json_encode($_SESSION['productos_seleccionados']);
            echo "'>";
            echo '<input id="ID_usuario" type="hidden" name="usuario" value="';
            echo $_SESSION['ID_usuario'];
            echo '">';
        ?>    
        <button class='boton_grande'> Generar Enlace <img class='icono' src="../iconos/links-fill.svg" alt=""></button>
    </form>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_usuarios.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
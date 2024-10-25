<?php
require 'headers/header_menu.php';
include 'backend/limpiar_session.php';
?>
<div id="ordenador">
    <form id="ordenador_form">
    </form>
</div>
</header>
<div id="div_principal-Menu">
    <!-- Div blanco con el mensaje de bienvenida y la imagen del usuario -->
    <div id="bienvenida_div" style="background-color: white; text-align: center; padding: 20px; border-radius: 10px; margin: 20px;">
        <h1>Bienvenido a PetMimos WebApp</h1>
        
        <!-- Aquí se colocaría la imagen del usuario -->
        <img src="./iconos/Icono-Usuario.svg" alt="Usuario" style="width: 100px; height: 100px; border-radius: 50%; margin-top: 20px;">
        
        <!-- Nombre del usuario -->
        <h2>Nombre del Usuario</h2>
        
        <!-- Pregunta debajo del nombre -->
        <p>¿Qué desea hacer en la app?</p>
    </div>

   
<article>
<h1> Menu de opciones</h1>
    <div class='menu_div'>
        <a href='./menu_empresa.php'>
            <img src='./iconos/Icono-Producto.svg' alt=''>
            <label> Gest&iacute;on de la tienda</label>
        </a>
        <a href='./menu_catalogo.php'>
            <img src='./iconos/Icono-Transacciones.svg' alt=''>
            <label> Gest&iacute;on de transacciones</label>
        </a>
        <a href='./menu_admin.php'>
            <img src='./iconos/Icono-G_Usuarios.svg' alt=''>
            <label> Gest&iacute;on de Usuario</label>
        </a>
        <a href='./backend/cerrar_sesion.php'>
            <img src='./iconos/Icono-Volver.svg' alt=''>
            <label> Volver a la página principal</label>
        </a>
    </div>
</article>

</body>

</html>
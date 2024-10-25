<?php include 'headers/header_catalogo.php'; ?>

<article id='articulo_banner'>
    <div class='slider' id='slider_banner'>
        <img id='objeto1' src='./img/banner.png' alt='banner'>
        <img id='objeto2' src='./img/banner1.png' alt='banner'>
        <img id='objeto3' src='./img/banner7.png' alt='banner'>
    </div>
</article>
<h1> Artículos</h1>
<article>
    <div class='slider_container'>
        <?php

        require './backend/conexion.php';

        $instruccion = 'SELECT p.ID_producto AS ID_producto, p.nombre AS nombre_producto, p.precio AS precio_producto, p.descripcion AS descripcion_producto, i.imagen AS imagen FROM productos p JOIN imagenes i ON p.ID_imagen = i.ID_imagen';

        $resultado = mysqli_query($conn, $instruccion);

        echo '<div class="slider">';
        while ($fila = mysqli_fetch_array($resultado)) {

            $ID_producto = $fila['ID_producto'];
            $nombre_producto = $fila['nombre_producto'];
            $precio_producto = $fila['precio_producto'];
            $descripcion_producto = $fila['descripcion_producto'];

            $imagen = $fila['imagen'];
            $imagen_base64 = base64_encode($imagen);

            echo '<a  class="producto">';
            echo '<img id="' . $ID_producto . '" class="producto_img"  src="data:image/jpeg;base64,' . $imagen_base64 . '" data-nombre="' . $nombre_producto . '" data-precio="' . $precio_producto . '" data-descripcion="' . $descripcion_producto . '" alt="' . $nombre_producto . '">';

            echo '</a>';
        }
        echo '</div>';
        echo '</div>';

        $resultado = mysqli_query($conn, $instruccion);

        echo '<div class="slider_nav">';
        while ($fila = mysqli_fetch_array($resultado)) {
            $ID_producto = $fila['ID_producto'];
            echo '<a href="#' . $ID_producto . '" class="scroll" ></a>';
        }
        echo '</div>';

        ?>
        <a id='anterior_producto'> <img src='./iconos/line/arrow-left-s.svg' alt='flecha'></a>
        <a id='siguiente_producto'> <img src='./iconos/line/arrow-right-s.svg' alt='flecha'></a>
</article>
<article id='contacto'>

    <h2>Contacto</h2>

    <a class='contacto' href='https://wa.me/598099979049'> <img class='icono' src='./iconos/whatsapp.png' )> Whatsapp
        099 979 049</a>

    <a class='contacto' href='https://www.instagram.com/pets_mimos_salto'> <img class='icono'
            src='./iconos/instagram.png' )> Instagram @pets_mimos_salto</a>

    <a class='contacto' href='https://www.facebook.com/Pets.Mimos.Salto/'> <img class='icono'
            src='./iconos/facebook.png' )> Facebook Pets Mimos</a>

    <a class='contacto' href="https://www.google.com/maps?cid=9728091245724571025
"> <img class='icono' src='iconos/map-pin-2-fill.svg' alt='' display='none'> Ubicación</a>
    <div id='mapa' class='mostrar'>
    </br>
        <iframe
            src='https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d425.7462065642846!2d-57.965512!3d-31.3874003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95addd7e4399f187%3A0x87011f7244001591!2sPets%20Mimos!5e0!3m2!1ses-419!2suy!4v1710715394767!5m2!1ses-419!2suy'
            style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'
            width='100%'></iframe>
    </div>

</article>

<div id='visor_producto'>
</div>

<footer>Pets Mimos © 2024</footer>

</body>



</html>
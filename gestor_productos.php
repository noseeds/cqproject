<?php
include "include/header.php";
?>
    <header>
        <h2> Pets Mimos </h2>
        <nav>
            <ul>
                <a class="boton, icono"><img src="iconos/menu.svg"></a>   
                <a class="boton, icono"><img src="iconos/bar-chart-2.svg"></a>
                <a href="login.php" class="boton, icono"><img src="iconos/account-circle.svg"></a>
                <a href="" class="boton, icono" ><img src="iconos/add-circle.svg"></a>
            </ul>
        </nav>
        <nav>
            <ul>
                <a> </a>
            </ul>
        </nav>
    </header>
    <div id="contenido">
        <form action="php/cargar_imagen.php" method="POST" id="formulario_cargar_imagen" enctype="multipart/form-data">
            <label for="subir_imagen" class="label_cargar_imagen">    <p>+</p>
            </label>
            <input type="file" name="imagen" id="subir_imagen" class="input_cargar_imagen">
            <div class="visualizador_imagenes">
                <?php require "php/conexion.php";
                $instruccion = "SELECT ID_imagen, imagen FROM imagenes";
                $resultado = mysqli_query($conn, $instruccion);
                while ($row = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                    $data_imagen = $row['imagen'];
                    $imagen_base64 = base64_encode($data_imagen);
                    echo "<img class='imagen_seleccionable' src='data:image/jpeg;base64," . $imagen_base64 . "' alt='imagen' />";
                }
                mysqli_free_result($resultado);
                mysqli_close($conn);
                ?>
            </div>
            <label id="respuesta_servidor"></label>
        </form>
        <form action="php/cargar_producto" method="POST">
            <input type="hidden" name="imagen_seleccionada" id="input_imagen_seleccionada">
            <input type="submit" id="enviar_producto" class="enviar_formulario" value="Subir producto">
        </form>
    </div>
    <script type="application/javascript" src="js/aplicacion.js"></script>
</body>
</html>
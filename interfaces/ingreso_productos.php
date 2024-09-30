<?php
require '../headers/header_interfaces.php';
?>
<h1> Registrar un Art&iacute;culo</h1>
<article id='articulo_productos'>
    <form id='formulario_cargar_imagen' action='../backend/cargar_imagen.php' method='POST' enctype='multipart/form-data'>
        <label for='subir_imagen' class='label_cargar_imagen'>
            <p>+</p>
        </label>
        <input type='file' name='imagen' id='subir_imagen' class='input_cargar_imagen'>
        <div class='visualizador_imagenes'>
            <?php require '../backend/conexion.php';
            $instruccion = 'SELECT ID_imagen, imagen FROM imagenes';
            $resultado = mysqli_query($conn, $instruccion);
            while ($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                $data_imagen = $fila['imagen'];
                $ID_imagen = $fila['ID_imagen'];
                $imagen_base64 = base64_encode($data_imagen);
                echo '<img data-imagen-id="'.$ID_imagen.'" class="imagen_seleccionable" src="data:image/jpeg;base64,' . $imagen_base64 . '" alt="imagen" />';
            }
            mysqli_free_result($resultado);
            mysqli_close($conn);
            ?>
        </div>
    </form>
    <form id='formulario_producto' action='../backend/cargar_producto.php' method='POST'>
        <label for='nombre'> Nombre</label>
        <input class='formulario_producto_input' type='text' name='nombre' placeholder='Nombre' required>
        <label for='descripcion'> Descripci&oacute;n</label>
        <textarea type='text' name='descripcion' placeholder='Descripci&oacute;n' rows='3'></textarea>
        <label for='stock'> Precio Unitario</label>
        <input class='formulario_producto_input' type='number' step="1" min="1" name='precio' placeholder='0 uyu'>
        <label for='stock'> Unidades</label>
        <input class='formulario_producto_input' type='number' step="1" min="0" name='stock' placeholder='0'>
        <div class="opciones_interfaz">
            <input id='boton_cancelar' type='button' name='cancelar' value='Cancelar'>
            <input type='hidden' id='input_imagen_seleccionada' name='imagen_seleccionada' value="">
            <input id='boton_guardar' type='submit' value='Guardar'>
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
    </form>
</article>
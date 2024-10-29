<?php
    require '../backend/comprobar_usuario.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Registrar un Art&iacute;culo</h1>
<article id='articulo_productos'>
    <form id='formulario_producto' action='../backend/cargar_producto.php' method='POST' enctype='multipart/form-data'>
        <div class='interfaz_imagen'>
            <label for='subir_imagen' class='cargar_imagen'>
                <img src="../iconos/image-add-fill.svg" alt="+">
            </label>
            <div class='visualizador_imagen'>
                <input type='file' name='imagen' id='subir_imagen' class='input_cargar_imagen' accept='image/*'>
                <img id='imagen_previa' src='' alt='Seleccione una imagen...'>
            </div>
        </div>

        <label for='nombre'> Nombre</label>
        <input  type='text' name='nombre' placeholder='Nombre' required>
        <label for='descripcion'> Descripci&oacute;n</label>
        <textarea type='text' name='descripcion' placeholder='Descripci&oacute;n' rows='3'></textarea>
        <label for='stock'> Precio Unitario</label>
        <input  type='number' step='1' min='1' name='precio' placeholder='0 uyu' required>
        <label for='stock'> Unidades</label>
        <input  type='number' step='1' min='0' name='stock' placeholder='0' required>
        <label for='stock_minimo'> (Opcional) Stock mínimo</label>
        <input  type='number' step='1' min='0' name='stock_minimo' placeholder='0'>
        <label for="categoria"> Categoria</label>
        <select name='categoria' required>
            <?php
            $instruccion = 'SELECT * FROM categorias';
            $resultado = mysqli_query($conn, $instruccion);
            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                $ID_categoria = $fila['ID_categoria'];
                $categoria = $fila['nombre'];
                echo "<option value='" . $ID_categoria . "'> $categoria</option>";
            }
            ?>
        </select>

        <div class='opciones_interfaz'>
            <button id='boton_cancelar' class='boton' type='button'> Cancelar</button>
            <button id='boton_guardar' class='boton' type='submit'> Guardar</button>
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
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_catalogo.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
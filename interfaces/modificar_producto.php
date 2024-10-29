<?php
    require '../backend/comprobar_usuario_administrador.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Editar producto</h1>

<article id='articulo_productos'>
    <?php
        if(isset($_GET['producto']) && !empty($_GET['producto'])) {
            $instruccion = 'SELECT
            p.nombre,
            p.descripcion,
            p.precio,
            p.stock,
            p.stock_minimo,
            c.ID_categoria,
            c.nombre AS categoria,
            i.imagen
            FROM productos p JOIN categoria_productos cp ON p.ID_producto = cp.ID_producto JOIN categorias c ON cp.ID_categoria = c.ID_categoria JOIN imagenes i ON p.ID_producto = i.ID_producto WHERE p.ID_producto = ' . $_GET['producto'];
            $resultado = mysqli_query($conn, $instruccion);
            if($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                $nombre = $fila['nombre'];
                $descripcion = $fila['descripcion'];
                $precio = $fila['precio'];
                $stock = $fila['stock'];
                $stock_minimo = $fila['stock_minimo'];
                $ID_categoria_actual = $fila['ID_categoria'];
                $categoria_actual = $fila['categoria'];
                $imagen = $fila['imagen'];
                $imagen_base64 = base64_encode($imagen);
            } else {
                Header('Location: ./gestion_productos.php?advertencia=' . urlencode('Ocurrió un error al intentar obtener el producto seleccionado. ' . mysqli_error($conn)));
            }
        } else {
            if(isset($_GET['advertencia']))
            {
                Header('Location: ./gestion_productos.php?advertencia=' . urlencode($_GET['advertencia']));
            } else if (empty($_GET['producto'])) {
                Header('Location: ./gestion_productos.php?advertencia=' . urlencode('No se ha podido detectar qué producto se pretende modificar'));
            }
        }

    ?>
    <form id='formulario_producto' action="../backend/actualizar_producto.php" method='POST'
        enctype='multipart/form-data'>
        <div class='interfaz_imagen'>
            <label for='subir_imagen' class='cargar_imagen'>
                <img src="../iconos/image-add-fill.svg" alt="+">
            </label>
            <div class='visualizador_imagen'>
                <input type='file' name='imagen' id='subir_imagen' class='input_cargar_imagen' accept='image/*'>
                <?php echo '<img id="imagen_previa" src="data:image/jpeg;base64,' . $imagen_base64 . '" alt="seleccione una imagen...">'; ?>
            </div>
        </div>

        <label for='nombre'> Nombre</label>
        <input type='text' name='nombre' placeholder='' <?php echo 'value="' . $nombre . '"'; ?> required>
        <label for='descripcion'> Descripci&oacute;n</label>
        <textarea type='text' name='descripcion' placeholder='Descripci&oacute;n'
            rows='3'><?php echo $descripcion; ?></textarea>
        <label for='stock'> Precio Unitario</label>
        <input type='number' step="1" min="1" name='precio' <?php echo 'value="' . $precio . '"'; ?>
            placeholder='0 uyu'>
        <label for='stock'> Unidades</label>
        <input type='number' step="1" min="0" name='stock' <?php echo 'value="' . $stock . '"'; ?> placeholder='0'>
        <label for='stock_minimo'> Stock mínimo</label>
        <input  type='number' step='1' min='0' name='stock_minimo' <?php echo 'value="' . $stock_minimo . '"'; ?> placeholder='0'>
        <label for="categoria"> Categoria</label>
        <select name='categoria'>
            <?php
            $instruccion = 'SELECT * FROM categorias';
            $resultado = mysqli_query($conn, $instruccion);
            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                $ID_categoria = $fila['ID_categoria'];
                $categoria = $fila['nombre'];
                if($ID_categoria == $ID_categoria_actual){
                    echo "<option value='" . $ID_categoria . "' selected> $categoria</option>";
                } else {
                    echo "<option value='" . $ID_categoria . "'> $categoria</option>";
                }
            }
            ?>
        </select>
        <?php echo '
        <input type="hidden" name="categoria_anterior" value="' . $ID_categoria_actual . '">'; ?>

        <div class='opciones_interfaz'>
            <input id='boton_cancelar' class='boton' type='button' name='cancelar' value='Cancelar'>
            <input id='boton_guardar' class='boton' type='submit' value='Guardar'>
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
        <img class='regresar' data-destino='./gestion_productos.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
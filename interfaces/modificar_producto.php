<?php
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';

    if(isset($_GET['producto']) && !empty($_GET['producto'])) {
        $_SESSION['producto'] = $_GET['producto'];
    }
?>
</header>
<h1> Editar producto</h1>

<article id='articulo_productos'>
    <?php
        $instruccion = 'SELECT p.nombre AS nombre, p.descripcion AS descripcion, p.precio AS precio, p.stock AS stock, c.ID_categoria AS ID_categoria, c.nombre AS categoria, i.imagen AS imagen FROM productos p JOIN categoria_productos cp ON p.ID_producto = cp.ID_producto JOIN categorias c ON cp.ID_categoria = c.ID_categoria JOIN imagenes i ON p.ID_imagen = i.ID_imagen WHERE p.ID_producto = ' . $_SESSION['producto'];
        $resultado = mysqli_query($conn, $instruccion);
        if($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $nombre = $fila['nombre'];
            $descripcion = $fila['descripcion'];
            $precio = $fila['precio'];
            $stock = $fila['stock'];
            $ID_categoria_actual = $fila['ID_categoria'];
            $categoria_actual = $fila['categoria'];
            $imagen = $fila['imagen'];
            $imagen_base64 = base64_encode($imagen);
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
        <input class='formulario_producto_input' type='text' name='nombre' placeholder=''
            <?php echo 'value="' . $nombre . '"'; ?> required>
        <label for='descripcion'> Descripci&oacute;n</label>
        <textarea type='text' name='descripcion' placeholder='Descripci&oacute;n'
            rows='3'><?php echo $descripcion; ?></textarea>
        <label for='stock'> Precio Unitario</label>
        <input class='formulario_producto_input' type='number' step="1" min="1" name='precio'
            <?php echo 'value="' . $precio . '"'; ?> placeholder='0 uyu'>
        <label for='stock'> Unidades</label>
        <input class='formulario_producto_input' type='number' step="1" min="0" name='stock'
            <?php echo 'value="' . $stock . '"'; ?> placeholder='0'>
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
</article>
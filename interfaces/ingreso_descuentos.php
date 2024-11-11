<?php
require '../backend/comprobar_usuario_administrador.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
require '../backend/funciones.php';
?>
<div id="ordenador">
    <form id="ordenador_form"></form>
</div>
</header>
<h1> Nuevo Descuento</h1>
<article>
    <h2> Detalles:</h2>
    <p> Ingrese uno por uno los productos a los cuales asignar un descuento... Finalmente, ajuste el porcentaje de
        descuento a asignar y presione Guardar.
    </p>
    <table id='tabla_registros'>
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Descuentos</th>
                <th>%total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if (isset($_SESSION['productos_seleccionados']) && !empty($_SESSION['productos_seleccionados'])) {
                foreach ($_SESSION['productos_seleccionados'] as $producto) {
                    echo '<tr>
                                <td class="celda_imagen"> <img src="data:image/jpeg;base64,' . $producto['imagen'] . '"> </td>
                                <td>' . $producto['ID_producto'] . '</td>
                                <td>' . $producto['nombre'] . '</td>
                                <td>' . $producto['categorias'] . '</td>
                                <td>' . $producto['stock'] . '</td>
                                <td>' . $producto['descuentos'] . '</td>
                                <td>' . $producto['porcentaje_total'] . '</td>
                              </tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <form action='../backend/actualizar_variables_session.php' method='POST'>
        <?php
        
        $instruccion = 'SELECT * FROM productos WHERE stock > 0 AND activo = 1';
        $resultado = mysqli_query($conn, $instruccion);
        echo '<select id="selector_productos" name="producto_para_agregar">';
        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo '<option value="' . $fila['ID_producto'] . '"';
            echo '>';
            echo $fila['nombre'];
            echo '</option>';
            $productos[] = [
                'ID' => $fila['ID_producto'],
                'cantidad' => $fila['stock'],
            ];
        }
        echo '</select>';
        ?>
        <input type='hidden' value='ingreso_descuentos' name='interfaz'>
        <input id='agregar_producto_al_descuento' type='submit' value='A&ntilde;adir'>
    </form>
    <form id='formulario_descuento' action='../backend/cargar_descuento.php' method='POST'>
        <label for='porcentaje'> Porcentaje de descuento:</label>
        <input type='number' step='5' min='0' max='99' value='5' placeholder='%' name='porcentaje' required>
        <label for='fecha_expiracion'> Válido hasta (por defecto hasta la próxima semana):</label>
        <input type='date' name='fecha_expiracion'>
    </form>
    <div class='opciones_interfaz'>
        <button id='boton_cancelar' class='boton'> Cancelar</button>
        <button id='boton_guardar' class='boton'> Guardar</button>
    </div>
    <?php
    echo '<label id="respuesta_servidor"';
    if (isset($_GET['notificacion'])) {
        echo ' class="notificacion">';
        echo $_GET['notificacion'];
    } else if (isset($_GET['advertencia'])) {
        echo ' class="advertencia">';
        echo $_GET['advertencia'];
    }
    echo '</label>';
    ?>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
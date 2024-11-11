<?php
require '../backend/comprobar_usuario.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Registro de Ventas</h1>
<article>
    <h2> Artículos:</h2>
    <table id='tabla_registros'>
        <thead>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Precio total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if (isset($_SESSION['productos_seleccionados']) && !empty($_SESSION['productos_seleccionados'])) {
                foreach ($_SESSION['productos_seleccionados'] as $producto) {
                    echo '<tr>
                                <td class="celda_imagen"> <img src="data:image/jpeg;base64,' . $producto['imagen'] . '"> </td>
                                <td>' . $producto['nombre'] . '</td>
                                <td>' . $producto['cantidad'] . '</td>
                                <td>' . $producto['precio'] . '</td>
                                <td>' . ($producto['cantidad'] * $producto['precio']) . '</td>
                              </tr>';
                    $total += $producto['cantidad'] * $producto['precio'];
                }
            }
            ?>
            <tr>
                <th>Total:</th>
                <td id='total'><?php echo $total; ?></td>
            </tr>
        </tbody>
    </table>
    <form id='formulario_agregar_producto' action='../backend/actualizar_variables_session.php' method='POST'>
        <?php
        $instruccion = 'SELECT * FROM productos WHERE stock > 0';
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
        <input type='number' min='1' value='1' name='cantidad'>
        <input type='hidden' value='ingreso_ventas' name='interfaz'>
        <input type='submit' value='A&ntilde;adir'>
    </form>
    <form id='formulario_venta' action='../backend/cargar_venta.php' method='POST'>
        <?php
        echo '<input type="hidden" name="productos" value="';
        echo json_encode($_SESSION['productos_seleccionados']);
        echo '">';
        echo '<input id="ID_usuario" type="hidden" name="usuario" value="';
        echo $_SESSION['ID_usuario'];
        echo '">';
        ?>
        <div id='contenedor_metodos_pago'>
        </div>
        <button class='boton_grande' type='button' id='agregar_metodo_pago'>Agregar Método de Pago</button>
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
<?php
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
?>
<h1> Registro de Ventas</h1>
<article>
    <h2> Artículos:</h2>
    <table class='tabla_registros'>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Precio total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if (!empty($_SESSION['productos_seleccionados'])) {
                foreach ($_SESSION['productos_seleccionados'] as $producto) {
                    echo '<tr>
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
                <td> <?php echo $total; ?> </td>
            </tr>
        </tbody>
    </table>
    <form id='formulario_agregar_producto' action='../backend/actualizar_variables_session.php' method='POST'>
        <?php
        $instruccion = "SELECT * FROM productos WHERE stock > '0'";
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
        <input type='submit' value='A&ntilde;adir'>
    </form>
    <form id='formulario_venta' action='../backend/cargar_venta.php' method='POST'></form>
    <div class='opciones_interfaz'>
        <button id='boton_cancelar'> Cancelar</button>
        <button id='boton_guardar'> Guardar</button>
    </div>
    </form>
</article>
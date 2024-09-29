<?php
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
?>
<h1> Registro de Ventas</h1>
<article>
    <h2> Artículos:</h2>
    <form id='formulario_venta' action='../backend/cargar_venta.php' method='POST'>
        <table>
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
                        var_dump($producto);
                        echo '<tr>
                                <td>' . $producto['nombre'] . '</td>
                                <td>' . $producto['cantidad'] . '</td>
                                <td>' . $producto['precio'] . '</td>
                                <td>' . ($producto['cantidad'] * $producto['precio']) . '</td>
                              </tr>';
                        $total += $producto['precio'];
                    }
                }
                ?>
                <tr>
                    <th>Total:</th>
                    <td> <?php echo $total; ?> </td>
                </tr>
            </tbody>
        </table>
        <?php
        $instruccion = "SELECT * FROM productos WHERE stock > '0'";
        $resultado = mysqli_query($conn, $instruccion);
        echo '<select id="selector_productos">';
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
        <form id='formulario_agregar_producto'>
            <input type='submit'>
        </form>
    </form>
</article>
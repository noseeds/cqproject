<?php
require '../backend/comprobar_usuario_administrador.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_productos.php';
?>
</header>
<h1> Nuevo Descuento</h1>
<article>
    <h2> Detalles:</h2>
    <table class='tabla_registros'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if ($_SESSION['productos_seleccionados'] && !empty($_SESSION['productos_seleccionados'])) {
                foreach ($_SESSION['productos_seleccionados'] as $producto) {
                    echo '<tr>
                                <td>' . $producto['ID_producto'] . '</td>
                                <td>' . $producto['nombre'] . '</td>
                                <td>' . $producto['categoria'] . '</td>
                                <td>' . $producto['stock'] . '</td>
                              </tr>';
                }
            }
            ?>
            <tr>
                <th>Total:</th>
                <td> <?php echo $total; ?> </td>
            </tr>
        </tbody>
    </table>
    <form id='formulario_descuento' action='../backend/cargar_descuento.php' method='POST'>
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
        <input type='submit' value='A&ntilde;adir'>
    </form>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
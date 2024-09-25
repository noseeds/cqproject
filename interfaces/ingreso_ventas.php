<?php
require '../headers/header_interfaces.php';
?>
<h1> Registro de Ventas</h1>
<article>
    <h2> Detalles:</h2>
    <form id='formulario_venta' action='../backend/cargar_venta.php' method='POST'>
        <?php
        require '../backend/conexion.php';
        if (isset($_GET['productos']) && !empty($_GET['productos'])) {
            $productos_con_cantidad = explode(',', $_GET['productos']);
            foreach ($productos_con_cantidad as $producto_con_cantidad) {
                list($ID_producto, $cantidad) = explode('-', $producto_con_cantidad);
                $productos[] = $ID_producto;
                $cantidad_productos[] = $cantidad;
            }
            foreach ($productos as $producto) {
                $instruccion = "SELECT * FROM productos";
                $resultado = mysqli_query($conn, $instruccion);
                echo '<select>';
                while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                    $ID_producto = $fila['ID_producto'];
                    echo '<option value="' . $ID_producto . '"';
                    if ($ID_producto == $producto) {
                        echo ' selected';
                    }
                    echo '>';
                    echo $fila['nombre'];
                    echo '</option>';
                }
                echo '</select>';
            }
        }
        $variables_get = $_SERVER['QUERY_STRING'];
        $productos = explode(',', $_GET['productos']);
        echo '<a href="./ingreso_ventas.php?' . $variables_get . ',0-0" id="anadir_producto">+</a>';
        ?>
        <input type='hidden' name='productos' <?php echo "value='$'"; ?>>
        <!-- ejemplo de valor del input productos: [id_producto]-[cantidad] 14-2 -->
        <input type='submit'>
    </form>
</article>
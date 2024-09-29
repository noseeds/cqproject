<?php
require '../headers/header_interfaces.php';
?>
<h1> Registro de Ventas</h1>
<article>
    <h2> Detalles:</h2>
    <form id='formulario_venta' action='../backend/cargar_venta.php' method='POST'>
        <?php
        require '../backend/conexion.php';

        /* CARGAR PRODUCTOS ANTERIORMENTE AÑADIDOS */
        /* EXTRAER LISTA DE PRODUCTOS DE LA VARIABLE GET */
        if (isset($_GET['productos']) && !empty($_GET['productos'])) {
            $productos_con_cantidad = explode(',', $_GET['productos']);
            foreach ($productos_con_cantidad as $producto_con_cantidad) {
                list($ID_producto, $cantidad) = explode('-', $producto_con_cantidad);
                $ID_productos[] = $ID_producto;
                $cantidad_productos[] = $cantidad;
            }
            /* INSERTAR CADA PRODUCTO COMO UN SELECT PARA DAR LA POSIBILIDAD DE CAMBIARLO */
            $productos[] = array();
            foreach ($ID_productos as $ID_producto) {
                $instruccion = "SELECT * FROM productos";
                $resultado = mysqli_query($conn, $instruccion);
                echo '<select>';
                while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                    echo '<option value="' . $fila['ID_producto'] . '"';
                    if ($fila['ID_producto'] == $ID_producto) {
                        echo ' selected';
                    }
                    echo '>';
                    echo $fila['nombre'];
                    echo '</option>';
                    $productos[] = [
                        'ID' => $producto,
                        'cantidad' => $cantidad,
                    ];
                }
                echo '</select>';
            }
        }
        /* PREPARAR URL con variables get PARA ADICIONAR PRODUCTOS */
        $variables_get = "productos=";
        for ($i = 0; $i < count($productos); $i++) {
            $variables_get += ',' . $productos;
        }
        $productos = explode(',', $_GET['productos']);
        echo '<a href="./ingreso_ventas.php?' . $variables_get . ',0-0" id="anadir_producto">+</a>';
        ?>
        <input type='hidden' name='productos' <?php echo "value='$'"; ?>>
        <!-- ejemplo de valor del input productos: [id_producto]-[cantidad] 14-2 -->
        <input type='submit'>
    </form>
</article>
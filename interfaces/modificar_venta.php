<?php
    require '../backend/comprobar_usuario_administrador.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Editar Venta</h1>
<article>
    <h2> Artículos:</h2>
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
    <table id='tabla_registros'>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal producto</th>
                <th>Descuento</th>
                <th>Precio total</th>
                <th> </th>
            </tr>
        </thead>
        <tbody id='tbody'>
            <?php
            $instruccion = 'SELECT
            p.ID_producto,
            p.nombre,
            p.precio,
            dv.cantidad,
            p.precio * dv.cantidad AS total_sin_descuento,
            IFNULL(SUM(d.porcentaje), 0) AS porcentaje_descuento,
            p.precio * dv.cantidad * (1 - IFNULL(SUM(d.porcentaje) / 100, 0)) AS total_producto
            FROM productos p
            JOIN detalles_venta dv
            ON p.ID_producto = dv.ID_producto
            JOIN ventas v
            ON dv.ID_venta = v.ID_venta
            LEFT JOIN descuento_productos dp
            ON p.ID_producto = dp.ID_producto
            LEFT JOIN descuentos d
            ON dp.ID_descuento = d.ID_descuento
            AND d.activo = 1
            AND d.fecha_expiracion > CURRENT_TIMESTAMP()
            WHERE v.ID_venta = ' . $_GET['venta'] . '
            GROUP BY p.ID_producto, p.nombre, p.precio, dv.cantidad;
            ';
            $productos = mysqli_query($conn, $instruccion);
            $productos2 = mysqli_query($conn, $instruccion);
            $total = 0;
            while($producto = mysqli_fetch_array($productos, MYSQLI_ASSOC)) {
            echo '
                <tr class="producto" data-producto="' . $producto['ID_producto'] . '" data-precio="' . $producto['total_producto'] . '">
                        <td>' . $producto['nombre'] . '</td>
                        <td>' . $producto['cantidad'] . '</td>
                        <td>' . number_format($producto['precio'], 2, ',', '.') . '</td>
                        <td>' . number_format($producto['total_sin_descuento'], 2, ',', '.') . '</td>
                        <td>' . $producto['porcentaje_descuento'] . '%</td>
                        <td>' . number_format($producto['total_producto'], 2, ',', '.') . '</td>
                        <td>
                            <a class="remover_producto">
                                <img class="icono" src="../iconos/delete-back-2-fill.svg">
                            </a>
                        </td>
                </tr>
            ';
            $total += $producto['total_producto'];
            }
            ?>
            <tr>
                <th>Total:</th>
                <td id='total'> <?php echo number_format($total, 2, ',', '.');; ?> </td>
            </tr>
        </tbody>
    </table>
    <form id='formulario_venta' action='../backend/actualizar_venta.php' method='POST'>
        <div>
        <?php
        $instruccion = 'SELECT * FROM productos WHERE stock > 0 AND activo = 1';
        $resultado = mysqli_query($conn, $instruccion);
        echo '<select id="selector_productos" name="producto_para_agregar">';
        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo '<option value="' . $fila['ID_producto'] . '"';
            echo '>';
            echo $fila['nombre'];
            echo '</option>';
        }
        echo '</select>';
        ?>
        <input id='cantidad_producto_agregar' type='number' min='1' value='1' name='cantidad'>
        <input id='agregar_producto_modificar_venta' type='button' value='A&ntilde;adir'>
        <?php echo '<input type="hidden" value="' . $_GET['venta'] . '" name="venta">'; ?>
        </div>
        <?php
        while($producto = mysqli_fetch_array($productos2, MYSQLI_ASSOC)) {
            echo '<input class="' . $producto['ID_producto'] . '" type="hidden" name="productos[]" value="' . $producto['ID_producto'] . '">';
            echo '<input class="' . $producto['ID_producto'] . '" type="hidden" name="cantidades[]" value="' . $producto['cantidad'] . '">';
        }
        echo '<input id="ID_usuario" type="hidden" name="usuario" value="';
        echo $_SESSION['ID_usuario'];
        echo '">';
        ?>
        <div id='contenedor_metodos_pago'>
        </div>
    </form>
    <button class='boton_grande' type='button' id='agregar_metodo_pago'>Agregar Método de Pago</button>
    <div class='opciones_interfaz'>
        <button id='boton_cancelar' class='boton'> Cancelar</button>
        <button id='boton_guardar' class='boton'> Guardar</button>
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
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
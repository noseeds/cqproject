<?php
require '../backend/comprobar_usuario.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_ventas.php';
?>
</header>

<h1> Detalles de la venta. </h1>
<article>
<h2> Artículos:</h2>
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
        <tbody>
    <?php
    echo '
    <thead>
    </thead>
    
    <tbody>';
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
    $productos2 = $productos;
    $total = 0;
    while($producto = mysqli_fetch_array($productos, MYSQLI_ASSOC)) {
    echo '
        <tr class="producto" data-producto="' . $producto['ID_producto'] . '" data-precio="' . $producto['total_producto'] . '">
                <td>' . $producto['nombre'] . '</td>
                <td>' . $producto['cantidad'] . '</td>
                <td>' . number_format($producto['precio'], 2) . '</td>
                <td>' . number_format($producto['total_sin_descuento'], 2) . '</td>
                <td>' . $producto['porcentaje_descuento'] . '%</td>
                <td>' . number_format($producto['total_producto'], 2) . '</td>
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
        <td id='total'> <?php echo number_format($total, 2, ',', '.'); ?> </td>
    </tr>
</tbody>
</table>

</article>

</body>

</html>
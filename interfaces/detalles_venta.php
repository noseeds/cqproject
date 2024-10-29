<?php
require '../backend/comprobar_usuario.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_ventas.php';
?>
</header>

<h1> Detalles de la venta. </h1>
<article>
    <?php
    $ID = $_GET['ID'];
    $usuario = '';
    $total = 0;

    $instruccion = 'SELECT
    v.metodo_pago,
    v.ID_venta,
    v.fecha,
    u.nombre AS usuario,
    p.nombre AS producto,
    dv.cantidad,
    p.precio,
    (dv.cantidad * p.precio) AS total_producto
    FROM ventas v
    JOIN usuarios u ON v.ID_usuario = u.ID_usuario
    JOIN detalles_venta dv ON v.ID_venta = dv.ID_venta
    JOIN productos p ON dv.ID_producto = p.ID_producto
    WHERE v.ID_venta = ' . $ID . '
    ORDER BY v.fecha DESC, v.ID_venta;
    ';

    $resultado = mysqli_query($conn, $instruccion);

    $fecha = date('d-m-y');
    $detalle_producto;
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_venta = $fila['ID_venta'];
        $producto = $fila['producto'];
        $precio = $fila['precio'];
        $cantidad = $fila['cantidad'];
        $total_producto = $fila['total_producto'];
        $metodo_pago = $fila['metodo_pago'];
        $usuario = $fila['usuario'];
        $fecha = $fila['fecha'];

        $detalle_producto[] = [
            'producto' => $producto,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'total_producto' => $total_producto,
        ];
        $total += $total_producto;
    }

    echo '<p>ID de registro: ' . $ID . '</p>';
    echo '<p>Venta ingresada por usuario: ' . $usuario . '</p>';
    echo '<p>En la fecha: ' . $fecha . '</p>';
    echo '<p>M&eacute;todo de pago: ' . $metodo_pago . '</p>';
    echo '<table class="tabla_registros">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total Producto</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($detalle_producto as $detalle) {
        echo '
                <tr>
                    <td>' . $detalle['producto'] . '</td>
                    <td>' . number_format($detalle['precio'], 2) . '</td>
                    <td>' . $detalle['cantidad'] . '</td>
                    <td>' . number_format($detalle['total_producto'], 2) . '</td>
                </tr>';
    }
    echo '
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total de la Venta:</strong></td>
                    <td><strong>' . number_format($total, 2) . '</strong></td>
                </tr>
            </tbody>
        </table>';
    ?>

</article>

</body>

</html>
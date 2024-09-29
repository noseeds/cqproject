<h1> Detalles de la venta. </h1>
<article>
    <?php
    include '../headers/header_interfaces.php';
    include '../backend/conexion.php';
    if (!$conn) {
        die('error de conexion con la base de datos');
    }

    $ID = $_GET['ID'];
    $instruccion = 'SELECT v.ID_venta, v.fecha, u.nombre AS usuario, p.nombre AS producto, dv.cantidad, p.precio, (dv.cantidad * p.precio) AS total_producto
    FROM ventas v
    JOIN usuarios u ON v.ID_usuario = u.ID_usuario
    JOIN detalles_venta dv ON v.ID_venta = dv.ID_venta
    JOIN productos p ON dv.ID_producto = p.ID_producto
    WHERE v.ID_venta = ' . $ID . '
    ORDER BY v.fecha DESC, v.ID_venta;
    ';

    $resultado = mysqli_query($conn, $instruccion);

    $total = 0;
    $usuario = '';
    $fecha = date('d-m-y');
    $detalle_producto[] = array();
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_venta = $fila['ID_venta'];
        $producto = $fila['producto'];
        $precio = $fila['precio'];
        $cantidad = $fila['cantidad'];
        $total_producto = $fila['total_producto'];
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
    echo '<table class="tabla_registros">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total Producto</th>
            </tr>';
    foreach ($detalle_producto as $detalle) {
        echo '<tr>
                        <td>' . $detalle['producto'] . '</td>
                        <td>' . number_format($detalle['precio'], 2) . '</td>
                        <td>' . $detalle['cantidad'] . '</td>
                        <td>' . number_format($detalle['total_producto'], 2) . '</td>
                      </tr>';
    }
    echo '<tr>
        <td colspan="3" style="text-align: right;"><strong>Total de la Venta:</strong></td>
        <td><strong>' . number_format($total, 2) . '</strong></td>
      </tr>';
    echo '</table>';

    ?>

</article>

</body>

</html>
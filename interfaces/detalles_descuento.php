<?php
require '../backend/comprobar_usuario.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_transacciones.php';
?>
</header>

<h1>Detalles del Descuento</h1>
<article>
<?php
    $ID = $_GET['ID'];
    $instruccion = '
    SELECT
    porcentaje,
    fecha,
    fecha_expiracion,
    CASE
        WHEN activo = 0 OR fecha_expiracion < CURRENT_TIMESTAMP()
        THEN "inactivo"
        ELSE "activo"
    END AS estado,
    CASE
        WHEN fecha_expiracion < CURRENT_TIMESTAMP()
        THEN "si"
        ELSE "no"
    END AS expirado
    FROM descuentos
    WHERE ID_descuento = ' . $ID;

    $resultado = mysqli_query($conn, $instruccion);
    $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    echo '<p>ID de registro: ' . $ID . '</p>';
    echo '<p>Descuento registrado en la fecha: ' . $fila['fecha'] . '</p>';
    if($fila['expirado'] === 'no') {
        echo '<p>Expira en la fecha: ' . $fila['fecha_expiracion'] . '</p>';
    } else {
        echo '<p>Expir&oacute; en la fecha: ' . $fila['fecha_expiracion'] . '</p>';
    }
    echo '<p>Estado: ' . $fila['estado'] . '</p>';
    echo '<p><b>Productos con este descuento: </b></p>';

    $instruccion = '
        SELECT
        p.nombre AS producto, 
        GROUP_CONCAT(DISTINCT CONCAT(d.porcentaje, "%") SEPARATOR ", ") AS descuentos,
        GROUP_CONCAT(DISTINCT c.nombre SEPARATOR ", ") AS categorias,
        SUM(p.precio * (d.porcentaje / 100)) AS descuento_total
        FROM productos p
        LEFT JOIN descuento_productos dp ON p.ID_producto = dp.ID_producto
        LEFT JOIN descuentos d ON dp.ID_descuento = d.ID_descuento
        LEFT JOIN categoria_productos cp ON p.ID_producto = cp.ID_producto
        LEFT JOIN categorias c ON cp.ID_categoria = c.ID_categoria
        WHERE d.ID_descuento = ' . $ID . ' AND d.activo = 1 AND d.fecha_expiracion > CURRENT_TIMESTAMP()
        GROUP BY p.ID_producto';
        
    $resultado = mysqli_query($conn, $instruccion);
    
    echo '
    <table id="tabla_registros">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descuentos activos</th>
                <th>Categorías</th>
                <th>Monto descontado por unidad</th>
            </tr>
        </thead>
        <tbody>';
        
    while ($producto = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        echo '
            <tr>
                <td>' . $producto['producto'] . '</td>
                <td>' . $producto['descuentos'] . '</td>
                <td>' . $producto['categorias'] . '</td>
                <td>' . number_format($producto['descuento_total'], 2, ',', '.') . '</td>
            </tr>';
    }
    
    echo '
        </tbody>
    </table>';
?>
</article>
</body>
</html>

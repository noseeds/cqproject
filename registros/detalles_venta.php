<?php
include '../headers/header_interfaces.php';
include '../backend/conexion.php';
if (!$conn) {
    die('error de conexion con la base de datos');
}

$ID = $_GET['ID'];
$instruccion = 'SELECT v.ID_venta AS IDv, p.precio AS precio, d.cantidad AS cantidad, v.fecha AS fecha, p.nombre AS nombre, v.ID_usuario AS usuario FROM ventas v JOIN detalles_venta d ON v.ID_venta = d.ID_venta JOIN productos p ON d.ID_producto=p.ID_producto WHERE v.ID_venta = ' .$ID. '';

$resultado = mysqli_query($conn, $instruccion);
$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

$precio = $fila['precio'];
$cantidad = $fila['cantidad'];
$nombre = $fila['nombre'];
$usuario = $fila['usuario'];
$fecha = $fila['fecha'];

echo '<h1> Detalles de la venta. </h1>';
echo '<p>' . $ID . ' ' . $nombre . ' ' . $precio . ' Total:' . $precio * $cantidad . ' Usuario:' . $usuario . ' ' . $fecha . '</p>';
?>

</body>

</html>
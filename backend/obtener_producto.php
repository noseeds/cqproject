<?php
require "../backend/conexion.php";
require '../backend/funciones.php';

if(isset($_GET['producto']) && !empty($_GET['producto'])) {
    $ID_producto = (int) sanitizar($_GET['producto']);
} else {
    die();
}
if(isset($_GET['venta']) && !empty($_GET['venta'])) {
    $ID_venta = (int) sanitizar($_GET['venta']);
} else {
    die();
}
if(isset($_GET['cantidad']) && !empty($_GET['cantidad'])) {
    $cantidad = (int) sanitizar($_GET['cantidad']);
} else {
    die();
}

if ($ID_producto) {
    $conn;

    if ($conn->connect_error) {
        die("error de conexión: " . $conn->connect_error);
    }

    $instruccion = 'SELECT
    p.ID_producto,
    p.nombre,
    p.precio,
    p.precio * ' . $cantidad . ' AS total_sin_descuento,
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
    WHERE v.ID_venta = ' . $ID_venta . ' AND p.ID_producto = ' . $ID_producto . '
    GROUP BY p.ID_producto, p.nombre, p.precio, dv.cantidad;';
    $resultado = mysqli_query($conn, $instruccion);
    
    if (mysqli_num_rows($resultado) > 0 && $producto = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        echo json_encode(array('success' => true, 'producto' => $producto));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Producto no encontrado'));
    }

} else {
    echo json_encode(array('success' => false, 'message' => 'ip invalida'));
}
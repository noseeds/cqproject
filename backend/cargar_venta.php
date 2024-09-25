<?php
require '../backend/conexion.php';
if (isset($_POST['productos']) && !empty($_POST['productos'])) {
    $ID_venta = mt_rand(1000, 9000);

    $productos_con_cantidad = explode(',', $_POST['productos']);
    foreach ($productos_con_cantidad as $producto) {
        list($ID_producto, $cantidad) = explode('-', $producto);
        $productos[] = $ID_producto;
        $cantidad_productos[] = $cantidad;
    }

    $instruccion_venta = "INSERT INTO ventas (ID_venta, ID_usuario) VALUES";
    $instruccion_venta .= " ($ID_venta, " . 11 . ")";
    $instruccion_detalles_venta = "INSERT INTO detalles_venta (ID_venta, ID_producto, cantidad) VALUES";
    for ($i = 0; $i < count($productos); $i++) {
        if ($i != 0) {
            $instruccion_detalles_venta .= ",";
        }
        $instruccion_detalles_venta .= " ($ID_venta, " . $productos[$i] . ", " . $cantidad_productos[$i] . ")";
    }
    $instruccion = $instruccion_venta . '; ' . $instruccion_detalles_venta . ';';
    echo $instruccion;
    if (mysqli_query($conn, $instruccion_venta) == true && mysqli_query($conn, $instruccion_detalles_venta) == true) {
        Header('Location: ../interfaces/ingreso_ventas.php?notificacion=' . urlencode('Venta registrada exitosamente'));
    } else {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error en la inserción de datos'));
    }
}
?>
<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['productos']) && !empty($_POST['productos'])
    && isset($_POST['usuario']) && !empty($_POST['usuario'])
    &&isset($_POST['metodo_pago']) && !empty($_POST['metodo_pago'])) {
    $productos = json_decode($_POST['productos'], true);
    if (is_array($productos) && $productos != [] && json_last_error() !== JSON_ERROR_NONE) {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Ingrese un producto para poder registrar su venta'));
        die();
    }
    $ID_usuario = $_POST['usuario'];
    $metodo_pago = $_POST['metodo_pago'];
    
    $consulta = mysqli_query($conn, 'SELECT IFNULL(MAX(ID_venta) + 1, 1) AS nueva_ID FROM ventas');
    $fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $ID_venta = $fila['nueva_ID'];
    mysqli_free_result($consulta);

    $instruccion_venta = 'INSERT INTO ventas (ID_venta, ID_usuario, metodo_pago) VALUES';
    $instruccion_venta .= ' (' . $ID_venta . ', ' . $ID_usuario . ', "' . $metodo_pago . '")';

    $instruccion_detalles_venta = 'INSERT INTO detalles_venta (ID_venta, ID_producto, cantidad) VALUES';
    $i=0;
    foreach($productos as $producto) {
        $i++;
        $instruccion_detalles_venta .= ' (' . $ID_venta . ', ' . $producto['ID_producto'] . ', ' . $producto['cantidad'] . ')';
        if($i != count($productos)) $instruccion_detalles_venta .= ',';
    }

    $instruccion = $instruccion_venta . '; ' . $instruccion_detalles_venta . ';' . 'UPDATE
    productos p
    JOIN detalles_venta dv
    ON p.ID_producto = dv.ID_producto
    SET p.stock = p.stock - dv.cantidad
    WHERE dv.ID_venta =' . $ID_venta;
    if (mysqli_query($conn, $instruccion_venta) == true && mysqli_query($conn, $instruccion_detalles_venta) == true) {
        Header('Location: ../interfaces/ingreso_ventas.php?notificacion=' . urlencode('Venta registrada exitosamente'));
    } else {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error en la inserción de datos'));
    }
} else {
    Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error al procesar los datos de la venta. '));

}
} else {
    Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Método de solicitud incorrecto. '));
}
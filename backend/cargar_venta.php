<?php
require '../backend/conexion.php';

if (isset($_POST['productos']) && !empty($_POST['productos'])
    && isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    if($_POST['productos'] != []) {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Ingrese un producto para poder registrar su venta'));
    }
    $productos = json_decode($_POST['productos'], true);
    $ID_usuario = $_POST['usuario'];
    
    $consulta = mysqli_query($conn, 'SELECT IFNULL(MAX(ID_venta) + 1, 1) AS nueva_ID FROM ventas');
    $fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $ID_venta = $fila['nueva_ID'];
    mysqli_free_result($consulta);

    $instruccion_venta = 'INSERT INTO ventas (ID_venta, ID_usuario) VALUES';
    $instruccion_venta .= ' (' . $ID_venta . ', ' . $ID_usuario . ')';

    $instruccion_detalles_venta = 'INSERT INTO detalles_venta (ID_venta, ID_producto, cantidad) VALUES';
    $i=0;
    foreach($productos as $producto) {
        $i++;
        $instruccion_detalles_venta .= ' (' . $ID_venta . ', '.$producto['ID_producto'].', '.$producto['cantidad'].')';
        if($i != count($productos)) $instruccion_detalles_venta .= ',';
    }

    $instruccion = $instruccion_venta . '; ' . $instruccion_detalles_venta . ';';
    if (mysqli_query($conn, $instruccion_venta) == true && mysqli_query($conn, $instruccion_detalles_venta) == true) {
        Header('Location: ../interfaces/ingreso_ventas.php?notificacion=' . urlencode('Venta registrada exitosamente'));
    } else {
        Header('Location: ../interfaces/ingreso_ventas.php?advertencia=' . urlencode('Error en la inserción de datos'));
    }
}
?>
<?php
require './conexion.php';
if(!$conn){
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) 
    && isset($_POST['precio']) && !empty($_POST['precio'])
    && isset($_POST['stock']) && !empty($_POST['stock'])
    && isset($_POST['descripcion'])
    && isset($_POST['categoria']) && !empty($_POST['categoria'])
    && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

        $imagen = $_FILES['imagen']['tmp_name'];
        $data_imagen = addslashes(file_get_contents($imagen));
        $instruccion = "INSERT INTO imagenes (imagen) VALUES ('$data_imagen')";
        if (mysqli_query($conn, $instruccion) !== TRUE) {
            Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Error en: ') . $instruccion . '<br>' . mysqli_error($conn));
            mysqli_close($conn);
            die();
        }
        $ID_imagen = mysqli_insert_id($conn);
        // CORROBORAR EXPRESION REGULAR de inputs con if() { die("mensaje") }
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $descripcion = $_POST['descripcion'];
        $ID_categoria = $_POST['categoria'];
        $instruccion = "INSERT INTO productos (ID_imagen, nombre, descripcion, precio, stock) VALUES ('$ID_imagen', '$nombre', '$descripcion', '$precio', '$stock')";
        if (mysqli_query($conn, $instruccion) === TRUE) {
            $ID_producto = mysqli_insert_id($conn);
            $instruccion = 'INSERT INTO categoria_productos (ID_producto, ID_categoria) VALUES (' . $ID_producto . ', ' . $ID_categoria . ')';
            if(mysqli_query($conn, $instruccion) === TRUE) {
                Header('Location: ../interfaces/ingreso_productos.php?notificacion=' . urlencode('Producto registrado exitosamente') . '#respuesta_servidor');
            } else {
                Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('No se ha podido asignar la categoría, pero el producto fue ingresado correctamente') . '#respuesta_servidor');
            }
        } else {
            Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Ocurrió un error al intentar ingresar el producto') . '#respuesta_servidor');
        }
        mysqli_close($conn);
        die();
    } else {
        Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Error en comprobacion de post') . '#respuesta_servidor');
        die();
    }
} else {
    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Método de solicitud inválido (debe ser POST).') . '#respuesta_servidor');
    die();
}
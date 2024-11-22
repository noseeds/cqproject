<?php
require './conexion.php';
require '../backend/funciones.php';
if(!$conn){
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) 
    && isset($_POST['precio']) && !empty($_POST['precio'])
    && isset($_POST['stock']) && !empty($_POST['stock'])
    && isset($_POST['stock_minimo'])
    && isset($_POST['descripcion'])
    && isset($_POST['categoria']) && !empty($_POST['categoria'])
    && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

        $imagen = $_FILES['imagen']['tmp_name'];
        $data_imagen = addslashes(file_get_contents($imagen));

        // CORROBORAR EXPRESION REGULAR de inputs con if() { die("mensaje") }
        $nombre = sanitizar($_POST['nombre']);
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $precio = (int) sanitizar($_POST['precio']);
        $stock = (int) sanitizar($_POST['stock']);
        $stock_minimo = (int) sanitizar($_POST['stock_minimo']);
        $descripcion = sanitizar($_POST['descripcion']);
        $descripcion = mysqli_real_escape_string($conn, $motivo);
        $ID_categoria = (int) sanitizar($_POST['categoria']);
        $instruccion = "INSERT INTO productos (nombre, descripcion, precio, stock, stock_minimo) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$stock_minimo')";
        if (mysqli_query($conn, $instruccion) === TRUE) {
            $ID_producto = mysqli_insert_id($conn);
            $instruccion = 'INSERT INTO categoria_productos (ID_producto, ID_categoria) VALUES (' . $ID_producto . ', ' . $ID_categoria . ')';
            if(mysqli_query($conn, $instruccion) === TRUE) {
                $instruccion = "INSERT INTO imagenes (ID_producto, imagen) VALUES ('$ID_producto', '$data_imagen')";
                if (mysqli_query($conn, $instruccion) === TRUE) {
                    Header('Location: ../interfaces/ingreso_productos.php?notificacion=' . urlencode('Producto registrado exitosamente') . '#respuesta_servidor');
                    die();
                } else {
                    Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Error al intentar insertar la imágen: ' . mysqli_error($conn)));
                }
            } else {
                Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('No se ha podido asignar la categoría, pero el producto fue ingresado correctamente') . '#respuesta_servidor');
            }
        } else {
            Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Ocurrió un error al intentar ingresar el producto') . '#respuesta_servidor');
        }
        mysqli_close($conn);
        die();
    } else {
        Header('Location: ../interfaces/ingreso_productos.php?advertencia=' . urlencode('Faltan datos requeridos. Intente seleccionar una imagen y revisar que todos los campos necesarios hayan sido completados') . '#respuesta_servidor');
        die();
    }
} else {
    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Método de solicitud inválido (debe ser POST).') . '#respuesta_servidor');
    die();
}
<?php
require "../backend/conexion.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['producto']) && !empty($_SESSION['producto'])
    && isset($_POST['nombre']) && !empty($_POST['nombre'])
    && isset($_POST['descripcion']) && !empty($_POST['descripcion'])
    && isset($_POST['precio']) && !empty($_POST['precio'])
    && isset($_POST['stock']) && !empty($_POST['stock'])
    && isset($_POST['categoria']) && !empty($_POST['categoria'])
    && isset($_POST['categoria_anterior']) && !empty($_POST['categoria_anterior'])
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
        $ID_producto = $_SESSION['producto'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $categoria_anterior = $_POST['categoria_anterior'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];

        $instruccion = 'UPDATE productos SET nombre = "' . $nombre . '", descripcion = "' . $descripcion . '", precio = ' . $precio . ', stock = ' . $stock . ', ID_imagen = ' . $ID_imagen . ' WHERE ID_producto = ' . $ID_producto;
        echo $instruccion;
        if(mysqli_query($conn, $instruccion)) {
            $instruccion = 'INSERT INTO categoria_productos (ID_producto, ID_categoria) VALUES (' . $ID_producto . ', ' . $ID_categoria . ')';
            if(mysqli_query($conn, $instruccion)) {
                $instruccion = 'DELETE FROM categoria_productos WHERE ID_producto =' . $ID_producto;
                Header('Location: ../interfaces/modificar_producto.php?notificacion=' . urlencode('Información del producto actualizada exitosamente') . '#respuesta_servidor');
            } else {
                Header('Location: ../interfaces/modificar_producto.php?notificacion=' . urlencode('Error al intentar asignar una categoría al producto') . '#respuesta_servidor');
            }
            die();
        } else {
            Header('Location: ../interfaces/modificar_producto.php?notificacion=' . urlencode('Ocurrió un error. No se ha modificado el producto'));
        }

    } else {
        Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error. Revise los datos ingresados y vuelva a intentar.') . '#respuesta_servidor');
        die();
    }
} else {
    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Método de solicitud inválido (debe ser POST).') . '#respuesta_servidor');
    die();
}
<?php
require '../backend/conexion.php';
require '../backend/comprobar_usuario_administrador.php';
require '../backend/funciones.php';

function comprobar_post()
{
    if (
        isset($_POST['producto']) && !empty($_POST['producto'])
        && isset($_POST['nombre']) && !empty($_POST['nombre'])
        && isset($_POST['descripcion']) && !empty($_POST['descripcion'])
        && isset($_POST['precio']) && !empty($_POST['precio'])
        && isset($_POST['stock']) && !empty($_POST['stock'])
        && isset($_POST['stock_minimo']) && !empty($_POST['stock_minimo'])
        && isset($_POST['categoria']) && !empty($_POST['categoria'])
    ) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        comprobar_post()
        && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK
    ) {

        $imagen = $_FILES['imagen']['tmp_name'];
        $data_imagen = addslashes(file_get_contents($imagen));

        // CORROBORAR EXPRESION REGULAR de inputs con if() { die("mensaje") }

        $ID_producto = (int) sanitizar($_POST['producto']);
        $nombre = sanitizar($_POST['nombre']);
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $descripcion = sanitizar($_POST['descripcion']);
        $descripcion = mysqli_real_escape_string($conn, $descripcion);
        $ID_categoria = (int) sanitizar($_POST['categoria']);
        $precio = (int) sanitizar($_POST['precio']);
        $stock = (int) sanitizar($_POST['stock']);
        $stock_minimo = (int) sanitizar($_POST['stock_minimo']);

        $instruccion = 'SELECT * FROM categoria_productos WHERE ID_producto =' . $ID_producto . ' AND ID_categoria =' . $ID_categoria;
        $resultado = mysqli_query($conn, $instruccion);
        if ($resultado) {
            if (mysqli_num_rows($resultado) == 0) {
                $instruccion = 'DELETE FROM categoria_productos WHERE ID_producto =' . $ID_producto;
                if (mysqli_query($conn, $instruccion)) {
                    $instruccion = 'INSERT INTO categoria_productos (ID_producto, ID_categoria) VALUES (' . $ID_producto . ', ' . $ID_categoria . ')';
                    if (!mysqli_query($conn, $instruccion)) {
                        Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error al intentar asignar una categoría al producto') . '#respuesta_servidor');
                    }
                } else {
                    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error de consulta. ' . mysqli_error($conn)) . '#respuesta_servidor');
                }
            }
        } else {
            Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error de consulta. ' . mysqli_error($conn)));
        }

        $instruccion = 'UPDATE productos SET nombre = "' . $nombre . '", descripcion = "' . $descripcion . '", precio = ' . $precio . ', stock_minimo = ' . $stock_minimo . ', stock = ' . $stock . ' WHERE ID_producto = ' . $ID_producto;
        if (mysqli_query($conn, $instruccion)) {
            $instruccion = 'DELETE FROM imagenes WHERE ID_producto=' . $ID_producto;
            mysqli_query($conn, $instruccion);
            if (mysqli_query($conn, $instruccion) === TRUE) {
                $instruccion = 'INSERT INTO imagenes (ID_producto, imagen) VALUES ($ID_producto, "' . $data_imagen . '")';
                if (mysqli_query($conn, $instruccion) === TRUE) {
                    Header('Location: ../interfaces/gestion_productos.php?notificacion=' . urlencode('Información del producto actualizada exitosamente') . '#respuesta_servidor');
                    die();
                } else {
                    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error ' . mysqli_error($conn)));
                }
            } else {
                Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error ' . mysqli_error($conn)));
            }
        } else {
            Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Ocurrió un error. No se ha modificado el producto' . mysqli_error($conn)));
        }
    } else if (comprobar_post() && !isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        $ID_producto = (int) sanitizar($_POST['producto']);
        $nombre = sanitizar($_POST['nombre']);
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $descripcion = sanitizar($_POST['descripcion']);
        $descripcion = mysqli_real_escape_string($conn, $descripcion);
        $ID_categoria = (int) sanitizar($_POST['categoria']);
        $precio = (int) sanitizar($_POST['precio']);
        $stock = (int) sanitizar($_POST['stock']);
        $stock_minimo = (int) sanitizar($_POST['stock_minimo']);

        $instruccion = 'SELECT * FROM categoria_productos WHERE ID_producto =' . $ID_producto . ' AND ID_categoria =' . $ID_categoria;
        $resultado = mysqli_query($conn, $instruccion);
        if ($resultado) {
            if (mysqli_num_rows($resultado) == 0) {
                $instruccion = 'DELETE FROM categoria_productos WHERE ID_producto =' . $ID_producto;
                if (mysqli_query($conn, $instruccion)) {
                    $instruccion = 'INSERT INTO categoria_productos (ID_producto, ID_categoria) VALUES (' . $ID_producto . ', ' . $ID_categoria . ')';
                    if (!mysqli_query($conn, $instruccion)) {
                        Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error al intentar asignar una categoría al producto ' . mysqli_error($conn)) . '#respuesta_servidor');
                    }
                } else {
                    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error de consulta. ' . mysqli_error($conn)) . '#respuesta_servidor');
                }
            }
        } else {
            Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error de consulta. ' . mysqli_error($conn)));
        }

        $instruccion = 'UPDATE productos SET nombre = "' . $nombre . '", descripcion = "' . $descripcion . '", precio = ' . $precio . ', stock_minimo = ' . $stock_minimo . ', stock = ' . $stock . ' WHERE ID_producto = ' . $ID_producto;
        if (mysqli_query($conn, $instruccion)) {
            Header('Location: ../interfaces/gestion_productos.php?notificacion=' . urlencode('Información del producto actualizada exitosamente') . '#respuesta_servidor');
            die();
        } else {
            Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Ocurrió un error. No se ha modificado el producto'));
        }
    } else {
        Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Error. Revise los datos ingresados y vuelva a intentar.') . '#respuesta_servidor');
        die();
    }
} else {
    Header('Location: ../interfaces/modificar_producto.php?advertencia=' . urlencode('Método de solicitud inválido.') . '#respuesta_servidor');
    die();
}
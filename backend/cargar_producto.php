<?php
    require './conexion.php';
    if(!$conn){
        die();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' 
    && isset($_POST['imagen_seleccionada']) && !empty($_POST['imagen_seleccionada']) 
    && isset($_POST['nombre']) && !empty($_POST['nombre']) 
    && isset($_POST['precio']) && !empty($_POST['precio'])
    && isset($_POST['stock']) && !empty($_POST['stock'])
    && isset($_POST['descripcion'])) {
        $imagen = $_POST['imagen_seleccionada']; /* ID de la imagen en la BDD */
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $descripcion = $_POST['descripcion'];
        
        $instruccion = "INSERT INTO productos (ID_imagen, nombre, descripcion, precio, stock) VALUES ('$imagen', '$nombre', '$descripcion', '$precio', '$stock')";
        if (mysqli_query($conn, $instruccion) === TRUE) {
            Header('Location: ../interfaces/ingreso_productos.php?notificacion=' . urlencode('Producto registrado exitosamente') . '#respuesta_servidor');
            die();
        } else {
            echo 'Error en: ' . $instruccion . '<br>' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
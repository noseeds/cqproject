<?php
    require './conexion.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen']['tmp_name'];
        $dataImagen = addslashes(file_get_contents($imagen));
        $instruccion = "INSERT INTO imagenes (imagen) VALUES ('$dataImagen')";
        if (mysqli_query($conn, $instruccion) === TRUE) {
            Header('Location: ../interfaces/ingreso_productos.php');
            die();
        } else {
            echo 'Error en: ' . $instruccion . '<br>' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
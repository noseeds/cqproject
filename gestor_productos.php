<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/aplicacion.css" >
    <style>

    </style>
    <script>

    </script>
</head>
<body>
    <div id="contenido">
        <form action="php/cargar_imagen.php" method="POST" enctype="multipart/form-data">
            <label for="imagen" class="label_cargar_imagen">    <p>+</p>
            </label>
            <input type="file" name="imagen" id="imagen" class="input_cargar_imagen">
            <input type="submit" class="enviar_formulario_imagen" value="Subir imagen">
            <div class="visualizador_imagenes">
                <img src="./img/mochila para gatos.jpg" alt="">
                <?php require "php/conexion.php";
                $instruccion = "SELECT ID_imagen, imagen FROM imagenes";
                $resultado = mysqli_query($conn, $instruccion);
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $data_imagen = $row['imagen'];
                    $imagen_base64 = base64_encode($data_imagen);
                    echo '<img src="data:image/jpeg;base64,' . $imagen_base64 . '" alt="Image" />';
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </div>
            <label id="respuesta_servidor"></label>
        </form>
        <form action="cargar_producto" method="POST">

        </form>
    </div>
</body>
</html>
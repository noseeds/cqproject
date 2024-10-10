<?php
require '../backend/conexion.php';
require '../headers/header_interfaces.php';
?>

<h1> Gestionar productos</h1>

<article>
    <h2> Catálogo:</h2>
    <table class='tabla_productos'>
        <thead>
            <tr>
                <th class='celda_imagen'> </th>
                <th> Nombre</th>
                <th> Descripcion</th>
                <th> Precio</th>
                <th> Stock</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            require '../backend/conexion.php';

            $instruccion = 'SELECT p.ID_producto AS ID_producto, p.nombre AS nombre, p.descripcion AS descripcion, p.precio AS precio, p.stock AS stock, i.imagen AS imagen FROM productos p JOIN imagenes i ON p.ID_imagen = i.ID_imagen';
            $resultado = mysqli_query($conn, $instruccion);
            while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                $ID_producto = $fila['ID_producto'];
                $nombre_producto = $fila['nombre'];
                $descripcion = $fila['descripcion'];
                $precio = $fila['precio'];
                $stock = $fila['stock'];
                $imagen = $fila['imagen'];
                $imagen_base64 = base64_encode($imagen);
                echo '<tr>';
                echo '<td class="celda_imagen"> <img src="data:image/jpeg;base64,' . $imagen_base64 . '"> </td>';
                echo '<td class="tabla_productos_celda"> ' . $nombre_producto . '</td>';
                echo '<td class="tabla_productos_celda"> ' . $descripcion . '</td>';
                echo '<td class="tabla_productos_celda"> ' . $precio . '</td>';
                echo '<td class="tabla_productos_celda"> ' . $stock . '</td>';
                echo '<td id="' . $ID_producto . '" class="tabla_productos_celda ,tabla_productos_opciones">';
                echo '<a class="editar_producto"><img src="../iconos/edit-2.svg"></a> <a class="eliminar_producto"><img src="../iconos/delete-bin-5.svg"></a>';
                echo '</td>';
                echo '</tr>';
            }
            mysqli_free_result($resultado);
            ?>
            <tr>

            </tr>
        </tbody>
    </table>
    <a href="../aplicacion.php"> <img src="" alt="regresar al menu"> </a>
</article>
<?php
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_productos.php';
?>
</header>
<h1> Gestionar productos</h1>

<article>
    <h2> Catálogo:</h2>
    <table class='tabla_productos'>
        <thead>
            <tr>
                <th class='celda_imagen'> </th>
                <th> Nombre</th>
                <th> Descripcion</th>
                <th> Categoria</th>
                <th> Precio</th>
                <th> Stock</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $atributo = 'nombre';
            $orden = 'DESC';
            if(isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
                $atributo = $_SESSION['ordenar_por'];
            }
            if(isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
                $orden = $_SESSION['orden_preferido'];
            }

            $instruccion = 'SELECT p.ID_producto, 
               p.nombre AS nombre, 
               p.descripcion, 
               p.precio, 
               p.stock, 
               p.activo,
               i.imagen, 
               GROUP_CONCAT(c.nombre) AS categoria
            FROM productos p 
            JOIN imagenes i ON p.ID_imagen = i.ID_imagen 
            JOIN categoria_productos cp ON p.ID_producto = cp.ID_producto 
            JOIN categorias c ON cp.ID_categoria = c.ID_categoria 
            GROUP BY p.ID_producto ORDER BY p.activo DESC, ' . $atributo . ' ' . $orden;
            $resultado = mysqli_query($conn, $instruccion);
            while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                $ID_producto = $fila['ID_producto'];
                $nombre_producto = $fila['nombre'];
                $descripcion = $fila['descripcion'];
                $categoria = $fila['categoria'];
                $precio = $fila['precio'];
                $stock = $fila['stock'];
                $activo = $fila['activo'];
                $imagen = $fila['imagen'];
                $imagen_base64 = base64_encode($imagen);
                echo '
                    <tr>
                        <td class="celda_imagen"> <img src="data:image/jpeg;base64,' . $imagen_base64 . '"> </td>
                        <td class="tabla_registros_celda"> ' . $nombre_producto . '</td>
                        <td class="tabla_registros_celda"> ' . $descripcion . '</td>
                        <td class="tabla_registros_celda"> ' . $categoria . '</td>
                        <td class="tabla_registros_celda"> ' . $precio . '</td>
                        <td class="tabla_registros_celda"> ' . $stock . '</td>
                        <td id="' . $ID_producto . '" class="tabla_registros_celda tabla_registros_opciones">';
                if($activo == 1)
                {
                    echo '<a class="editar_producto"><img src="../iconos/edit-2.svg"></a> <a class="desactivar_producto"><img src="../iconos/line/checkbox-indeterminate-line.svg"></a>';
                } else {
                    echo '<a class="editar_producto"><img src="../iconos/edit-2.svg"></a> <a class="activar_producto"><img src="../iconos/checkbox-indeterminate-fill.svg"></a>';
                }
                echo '
                </td>
                </tr>';

            }
            mysqli_free_result($resultado);
            ?>
        </tbody>
    </table>
    <picture>
        <source media="(min-width: 48rem)" srcset="../img/regresar_largo.png">
        <source media="(max-width: 48rem)" srcset="../img/regresar.png">
        <img class='regresar' src="../img/regresar_largo.png" alt="regresar">
    </picture>

</article>
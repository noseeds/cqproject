<?php
require '../backend/comprobar_usuario_administrador.php';
require '../backend/conexion.php';
require '../headers/header_interfaces.php';
include '../headers/ordenador_ventas.php';
?>
</header>
<h1> Ventas </h1>
<article>
    <?php

    $atributo = 'fecha';
    $orden = 'DESC';
    if(isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
        $atributo = $_SESSION['ordenar_por'];
    }
    if(isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
        $orden = $_SESSION['orden_preferido'];
    }

    $instruccion = 'SELECT
    u.ID_usuario,
    u.nombre AS nombre_usuario,
    v.ID_venta,
    v.fecha,
    v.metodo_pago,
    GROUP_CONCAT(p.nombre, " (x", dv.cantidad, ")" ORDER BY dv.cantidad DESC SEPARATOR ", ") AS productos,
    SUM(p.precio * dv.cantidad) AS total_producto
    FROM ventas v
    JOIN usuarios u
    ON v.ID_usuario = u.ID_usuario
    JOIN detalles_venta dv
    ON v.ID_venta = dv.ID_venta
    JOIN productos p
    ON dv.ID_producto = p.ID_producto
    GROUP BY v.ID_venta, u.ID_usuario
    ORDER BY ' . $atributo . ' ' . $orden;
    $resultado = mysqli_query($conn, $instruccion);

    echo '<table id="tabla_ventas" class="tabla_registros">
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Usuario</th>
                <th>C&oacute;digo</th>
                <th>Fecha</th>
                <th>Productos</th>
                <th>Metodo</th>
                <th>Total</th>
            </tr>
        </thead>';
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_usuario = $fila['ID_usuario'];
        $nombre_usuario = $fila['nombre_usuario'];
        $ID_venta = $fila['ID_venta'];
        $fecha = $fila['fecha'];
        $productos = $fila['productos'];
        $metodo_pago = $fila['metodo_pago'];
        $total_producto = number_format($fila['total_producto'], 2);
        echo '
        <tbody>
            <tr>
                <td>' . $ID_usuario . '</td>
                <td>' . $nombre_usuario . '</td>
                <td>' . $ID_venta . '</td>
                <td>' . $fecha . '</td>
                <td>' . $productos . '</td>
                <td>' . $metodo_pago . '</td>
                <td>' . $total_producto . '</td>
                <td id="' . $ID_venta . '" class="tabla_registros_celda tabla_registros_opciones">
                    <a class="editar_venta">
                        <img src="../iconos/edit-2.svg">
                    </a>
                    <a class="eliminar_venta">
                        <img src="../iconos/line/checkbox-indeterminate-line.svg">
                    </a>
                </td>
            </tr>';
    }
    mysqli_free_result($resultado);
    ?>
        </tbody>
    </table>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
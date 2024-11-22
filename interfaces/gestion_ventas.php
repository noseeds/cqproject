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
    echo '<label id="respuesta_servidor"';
    if(isset($_GET['notificacion'])){
        echo ' class="notificacion">';
        echo $_GET['notificacion'];
    } else if(isset($_GET['advertencia'])){
        echo ' class="advertencia">';
        echo $_GET['advertencia'];
    }
    echo '</label>';

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
    GROUP_CONCAT(DISTINCT m.nombre SEPARATOR ", ") AS metodo_pago,
    vm.cantidad_paga,
    GROUP_CONCAT(DISTINCT CONCAT("ID-", p.ID_producto, " ", p.nombre, " (x", dv.cantidad, ")") ORDER BY dv.cantidad DESC SEPARATOR ", ") AS productos,
    CASE
        WHEN v.activo = 1 THEN "activa"
        ELSE "inactiva"
    END AS estado
    FROM ventas v
    JOIN usuarios u ON v.ID_usuario = u.ID_usuario
    JOIN detalles_venta dv ON v.ID_venta = dv.ID_venta
    JOIN productos p ON dv.ID_producto = p.ID_producto
    JOIN venta_metodos_pago vm ON v.ID_venta = vm.ID_venta
    JOIN metodos_pago m ON vm.ID_metodo_pago = m.ID_metodo_pago
    GROUP BY v.ID_venta, u.ID_usuario
    ORDER BY v.activo DESC, ' . $atributo . ' ' . $orden;
    $instruccion2 = 'SELECT 
    v.ID_venta,
    SUM(vm.cantidad_paga) AS total_venta
    FROM ventas v
    JOIN venta_metodos_pago vm ON v.ID_venta = vm.ID_venta
    GROUP BY v.ID_venta;
    ';

    $ventas = mysqli_query($conn, $instruccion);
    $totales_ventas = mysqli_query($conn, $instruccion2);
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
                <th>Estado</th>
            </tr>
        </thead>';
    while ($venta = mysqli_fetch_array($ventas, MYSQLI_ASSOC)) {
        $ID_usuario = $venta['ID_usuario'];
        $nombre_usuario = $venta['nombre_usuario'];
        $ID_venta = $venta['ID_venta'];
        $fecha = $venta['fecha'];
        $productos = $venta['productos'];
        $metodo_pago = $venta['metodo_pago'];
        $estado = $venta['estado'];
        $total = mysqli_fetch_array($totales_ventas, MYSQLI_ASSOC);
        $total_venta = number_format($total['total_venta'], 2);
        echo '
        <tbody>
            <tr data-producto="' . $ID_venta . '">
                <td>' . $ID_usuario . '</td>
                <td>' . $nombre_usuario . '</td>
                <td>' . $ID_venta . '</td>
                <td>' . $fecha . '</td>
                <td>' . $productos . '</td>
                <td>' . $metodo_pago . '</td>
                <td>' . number_format($total_venta, 2, ',', '.') . '</td>
                <td>' . $estado . '</td>
                <td id="' . $ID_venta . '" class="tabla_registros_celda tabla_registros_opciones">';
                if($estado === 'activa')
                {
                    echo '<a class="desactivar_venta"><img src="../iconos/line/checkbox-indeterminate-line.svg"></a>';
                } else {
                    echo '<a class="activar_venta"><img src="../iconos/checkbox-indeterminate-fill.svg"></a>';
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
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
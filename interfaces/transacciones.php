<?php
require "../headers/header_interfaces.php";
?>
</header>

<h1>Transacciones</h1>
<article id='transacciones'>
    <div class="banner_simple">
        <img id="banner_ingresos" class="banner" src="../img/ingresos-banner.png" onclick='' alt="banner de ingresos">
        <img id="banner_egresos" class="banner" src="../img/egresos-banner.png" alt="banner de egresos">
    </div>
    <table>
        <?php
        include '../backend/conexion.php';
        if (!$conn) {
            die('error de conexion con la base de datos');
        }
        $atributo = $_SESSION['ordenar_por'];
        $orden = $_SESSION['orden_preferido'];
        $instruccion = 'SELECT v.ID_venta AS ID, "venta" AS tipo, p.precio AS valor, v.fecha AS fecha, p.nombre AS descripcion, d.cantidad AS cantidad, u.nombre AS usuario FROM ventas v JOIN detalles_venta d ON v.ID_venta = d.ID_venta JOIN productos p ON d.ID_producto=p.ID_producto JOIN usuarios u ON v.ID_usuario = u.ID_usuario UNION ALL SELECT g.ID_gasto AS ID, "egreso" AS tipo, g.valor AS valor, g.fecha AS fecha, g.motivo AS descripcion, "" AS cantidad, u.nombre AS usuario FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;
        if (isset($_GET['transacciones_a_mostrar']) && $_GET['transacciones_a_mostrar'] == 'ingresos') {
            $instruccion = 'SELECT v.ID_venta AS ID, "venta" AS tipo, p.precio AS valor, v.fecha AS fecha, p.nombre AS descripcion, d.cantidad AS cantidad, u.nombre AS usuario FROM ventas v JOIN detalles_venta d ON v.ID_venta = d.ID_venta JOIN productos p ON d.ID_producto=p.ID_producto JOIN usuarios u ON v.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;
        } else if (isset($_GET['transacciones_a_mostrar']) && $_GET['transacciones_a_mostrar'] == 'egresos') {
            $instruccion = 'SELECT g.ID_gasto AS ID, "egreso" AS tipo, g.valor AS valor, g.fecha AS fecha, g.motivo AS descripcion, "" AS cantidad, u.nombre AS usuario FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;

        }
        $resultado = mysqli_query($conn, $instruccion);
        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $ID = $fila['ID'];
            $tipo = $fila['tipo'];
            $valor = $fila['valor'];
            $cantidad = $fila['cantidad'];
            $fecha = $fila['fecha'];
            $descripcion = $fila['descripcion'];
            if ($tipo == 'venta') {
                echo '<tr class="' . $tipo . '">';
                echo '<td class="col1"><img src="../iconos/money-dollar-circle-white.png"></td>';
                echo '<td class="col2">
                    <a href="../registros/detalles_venta.php?ID=' . $ID . '">' . ucfirst($tipo) . '</a>
                    <label>' . $descripcion . '</label></td>';
                echo '<td class="col3">
                    ' . $fecha . '
                </td>';
                echo '<td class="col4">
                    $' . $valor * $cantidad . '
                </td>';
                echo '</tr>';

            } else {
                echo '<tr class="' . $tipo . '">';
                echo '<td class="col1"><img src="../iconos/money-dollar-circle-white.png"></td>';
                echo '<td class="col2">
                <a href="../registros/detalles_egreso.php?ID=' . $ID . '">' . ucfirst($tipo) . '</a>
                <label>' . $descripcion . '</label></td>';
                echo '<td class="col3">
                ' . $fecha . '
            </td>';
                echo '<td class="col4">
                $' . $valor . '
            </td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
    </a>

    </body>

    </html>
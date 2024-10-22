<?php
include '../headers/header_interfaces.php';
include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Egresos </h1>
<article>
    <?php
    include '../backend/conexion.php';

    $atributo = 'fecha';
    $orden = 'DESC';
    if(isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
        $atributo = $_SESSION['ordenar_por'];
    }
    if(isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
        $orden = $_SESSION['orden_preferido'];
    }

    $instruccion = 'SELECT g.ID_usuario AS ID_usuario, u.nombre AS nombre_usuario, g.ID_gasto AS ID_gasto, g.motivo AS motivo, g.valor AS valor, g.fecha AS fecha FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;
    $resultado = mysqli_query($conn, $instruccion);

    echo '<table class="tabla_registros">
        <thead>
            <tr>
                <th>Codigo egreso</th>
                <th>ID Usuario</th>
                <th>Usuario</th>
                <th>Valor</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
        </thead>';
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_gasto = $fila['ID_gasto'];
        $ID_usuario = $fila['ID_usuario'];
        $nombre_usuario = $fila['nombre_usuario'];
        $valor = number_format($fila['valor'], 2);
        $motivo = $fila['motivo'];
        $fecha = $fila['fecha'];
        echo '
        <tbody>
            <tr>
                <td>' . $ID_gasto . '</td>
                <td>' . $ID_usuario . '</td>
                <td>' . $nombre_usuario . '</td>
                <td>' . $valor . '</td>
                <td>' . $motivo . '</td>
                <td>' . $fecha . '</td>
                <td id="' . $ID_gasto . '" class="tabla_registros_celda tabla_registros_opciones">
                    <a class="editar_gasto">
                        <img src="../iconos/edit-2.svg">
                    </a>
                    <a class="eliminar_gasto">
                        <img src="../iconos/line/checkbox-indeterminate-line.svg">
                    </a>
                </td>
            </tr>';
    }
    mysqli_free_result($resultado);
    ?>
            </tbody>
    </table>
</article>
</body>

</html>
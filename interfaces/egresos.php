<?php
include '../headers/header_interfaces.php';
include '../headers/ordenador_transacciones.php';
?>
</header>
<h1> Egresos </h1>
<article>
    <?php
    include '../backend/conexion.php';

    $atributo = $_SESSION['ordenar_por'];
    $orden = $_SESSION['orden_preferido'];

    $instruccion = 'SELECT u.nombre AS usuario, g.ID_gasto AS ID, g.motivo AS motivo, g.valor AS valor, g.fecha AS fecha FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;
    $resultado = mysqli_query($conn, $instruccion);

    echo '<table class="tabla_registros">
            <tr>
                <th> ID</th>
                <th> Usuario</th>
                <th> Motivo</th>
                <th> Valor</th>
                <th> Fecha</th>
                <th> </th>
            </tr>';
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    echo '<tr>
            <td>' . $fila['ID'] . '</td>
            <td>' . $fila['usuario'] . '</td>
            <td>' . $fila['motivo'] . '</td>
            <td>' . number_format($fila['valor'], 2) . '</td>
            <td>' . $fila['fecha'] . '</td>
            <td> <a id="editar_egreso"><img src="../iconos/edit-2.svg"></a> <a id="eliminar_egreso"><img src="../iconos/line/checkbox-indeterminate-line.svg"></a>
            </td>
            </tr>';
    }
    echo '</table>';
    ?>
</article>
</body>

</html>
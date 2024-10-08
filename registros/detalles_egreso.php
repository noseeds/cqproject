<h1> Detalles de egreso </h1>
<article>
    <?php
    include '../headers/header_interfaces.php';
    include '../backend/conexion.php';
    if (!$conn) {
        die('error de conexion con la base de datos');
    }

    $ID = $_GET['ID'];
    $instruccion = 'SELECT u.nombre AS usuario, g.ID_gasto AS ID, g.motivo AS motivo, g.valor AS valor, g.fecha AS fecha FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario WHERE g.ID_gasto = ' . $ID;

    $resultado = mysqli_query($conn, $instruccion);
    $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    echo '<p>ID de registro: ' . $ID . '</p>';
    echo '<p>Egreso registrado por usuario: "' . $fila['usuario'] . '"</p>';
    echo '<p>En la fecha: ' . $fila['fecha'] . '</p>';
    echo '<table class="tabla_registros">
            <tr>
                <th>Usuario</th>
                <th>Motivo</th>
                <th>Valor</th>
                <th>Fecha</th>
            </tr>';
    echo '<tr>
            <td>' . $fila['usuario'] . '</td>
            <td>' . $fila['motivo'] . '</td>
            <td>' . number_format($fila['valor'], 2) . '</td>
            <td>' . $fila['fecha'] . '</td>

            </tr>';
    echo '</table>';
?>
</article>
</body>

</html>
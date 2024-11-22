<?php
require '../backend/comprobar_usuario.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_transacciones.php';
?>
</header>

<h1> Detalles de egreso </h1>
<article>
<?php
    $ID = $_GET['ID'];
    $instruccion = 'SELECT u.nombre AS usuario, g.ID_gasto AS ID, g.motivo AS motivo, g.valor AS valor, g.fecha AS fecha FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario WHERE g.ID_gasto = ' . $ID;

    $resultado = mysqli_query($conn, $instruccion);
    $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    echo '<p>ID de registro: ' . $ID . '</p>';
    echo '<p>Egreso registrado por usuario: "' . $fila['usuario'] . '"</p>';
    echo '<p>En la fecha: ' . $fila['fecha'] . '</p>';
    echo '
    <table class="tabla_registros">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Motivo</th>
                <th>Valor</th>
                <th>Fecha</th>
            </tr>
        </thead>';
    echo '
        <tbody>
            <tr>
                <td>' . $fila['usuario'] . '</td>
                <td>' . $fila['motivo'] . '</td>
                <td>' . number_format($fila['valor'], 2, ',', '.') . '</td>
                <td>' . $fila['fecha'] . '</td>
            </tr>
        </tbody>
    </table>';
?>
</article>
</body>

</html>
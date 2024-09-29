<h1> Detalles de egreso </h1>
<article>
    <?php
include '../headers/header_interfaces.php';
include '../backend/conexion.php';
if (!$conn) {
    die('error de conexion con la base de datos');
}

$ID = $_GET['ID'];
$instruccion = 'SELECT * FROM gastos WHERE ID_gasto = ' . $ID;

$resultado = mysqli_query($conn, $instruccion);
$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

$motivo = $fila['motivo'];
$valor = $fila['valor'];
$fecha = $fila['fecha'];
echo '<p> ID: ' . $ID . '  Motivo: ' . $motivo . '  Valor: ' . $valor . '  Fecha: ' . $fecha . '</p>';
?>
</article>
</body>

</html>
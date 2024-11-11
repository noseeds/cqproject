<?php
require '../backend/conexion.php';

$instruccion = 'SELECT ID_metodo_pago, nombre FROM metodos_pago';
$resultado = mysqli_query($conn, $instruccion);

$metodos_pago = [];

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $metodos_pago[] = $fila;
    }
}

header('Content-Type: application/json');
echo json_encode($metodos_pago);
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ordenar_por'])) {
        $ordenar_por = $_POST['ordenar_por'];
        $orden_preferido = $_POST['orden_preferido'];
        $_SESSION['ordenar_por'] = $ordenar_por;
        $_SESSION['orden_preferido'] = $orden_preferido;

        echo json_encode(['estado' => 'exito', 'ordenar_por' => $_SESSION['ordenar_por'], 'orden_preferido' => $_SESSION['orden_preferido']]);
        die();
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Ninguna opcion seleccionada']);
    }
} else {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Método de solicitud inválido (debe ser POST)']);
}
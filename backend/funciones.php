<?php
function registrar_auditoria($conexion, $id_registro, $tabla, $campo, $valor_anterior, $valor_nuevo, $accion, $id_usuario) {
    $fecha_cambio = date("Y-m-d H:i:s");
    $sql = "INSERT INTO auditoria (ID_registro_auditado, tabla, campo, valor_anterior, valor_nuevo, fecha_cambio, ID_usuario, accion) 
            VALUES ('$id_registro', '$tabla', '$campo', '$valor_anterior', '$valor_nuevo', '$fecha_cambio', '$id_usuario', '$accion')";
    mysqli_query($conexion, $sql);
}
function sanitizar(string $cadena): string {

    $cadena = strip_tags($cadena);
    $cadena = htmlspecialchars($cadena, ENT_QUOTES, 'UTF-8');
    $cadena = trim($cadena);
    $cadena = preg_replace('/\s+/', ' ', $cadena);

    return $cadena;
}
<?php
function sanitizar($entrada) {
    if (is_numeric($entrada)) {
        if (strpos(strtolower($entrada), 'e') !== false) {
            die('El formato de n&uacute;mero cient&iacute;fico no est&aacute; permitido');
        }
        $numero = (int)$entrada;
        if (strlen((string)$numero) > 11 ) {
            die('El n&uacute;mero excede el tama&ntilde;o soportado');
        }
        return $numero;
    }

    if (!empty($entrada)) {
        $cadena_texto = $entrada;
        // decodificar caracteres de codificación URL (por ejemplo, %27 se convierte en ' para que después addslashes pueda escaparlas correctamente)
        $cadena_texto = rawurldecode($cadena_texto);
        // remueve símbolos de comentario de SQL para evitar ataques de "truncamiento"
        $cadena_texto = preg_replace('/(--|#)/', '', $cadena_texto);
        // remueve caracteres no imprimibles o inválidos en UTF-8
        $cadena_texto = mb_convert_encoding($cadena_texto, 'UTF-8', 'UTF-8');
        // remueve etiquetas HTML y PHP
        $cadena_texto = strip_tags($cadena_texto);
        // convertir caracteres especiales a entidades HTML (por ejemplo, ñ se convierte en &ntilde; á en &aacute; y & en &amp;)
        $cadena_texto = htmlspecialchars($cadena_texto, ENT_QUOTES, 'UTF-8');
        // eliminar espacios extra
        $cadena_texto = trim($cadena_texto); // remueve espacios al inicio y final
        $cadena_texto = preg_replace('/\s+/', ' ', $cadena_texto); // remueve espacios repetidos
        $cadena_texto = addslashes($cadena_texto);

        return $cadena_texto;
    }

    return '';
}

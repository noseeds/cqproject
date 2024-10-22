<?php
require '../headers/header_interfaces.php';

$api_key = '6b2344deb47d222d95e4e8b375668cd3';

$url = 'https://api.exchangeratesapi.io/v1/latest?access_key=' . $api_key;

// Obteniendo datos de la API
$respuesta = file_get_contents($url);

// Verificando si la solicitud fue exitosa
if ($respuesta === FALSE) {
    die('Ocurrió un error al obtener los datos.');
}

// Decodificando la respuesta JSON en un array de PHP
$datos = json_decode($respuesta, true);

// Verificando si 'tasas' existe en la respuesta
if (isset($datos['rates'])) {
    // Extrayendo las tasas
    $tasas_usd = $datos['rates'];
} else {
    die('No se encontraron tasas de cambio.');
}

?>
</header>

<body>
    <h1>Tasas de Cambio USD</h1>
    <article>
        <table border='1'>
            <tr>
                <th>Moneda</th>
                <th>Tasa</th>
            </tr>
            <?php
            foreach ($tasas_usd as $moneda => $tasa) {
                if($moneda === 'UYU') {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($moneda) . '</td>';
                    echo '<td>' . number_format($tasa, 4) . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </article>
</body>

</html>
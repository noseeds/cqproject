<div id='alertas_restock'>
    <?php
    $instruccion = 'SELECT
    ID_producto, nombre, stock, stock_minimo
    FROM productos
    WHERE stock < stock_minimo OR stock = 0
    ';
    if ($resultado = mysqli_query($conn, $instruccion)) {
        if(mysqli_num_rows($resultado) > 0) {
            $_SESSION['alertas'] = [];
            while ($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                $alerta = [];
                $alerta['ID_producto'] = $fila['ID_producto'];
                $alerta['nombre'] = $fila['nombre'];
                $alerta['stock'] = $fila['stock'];
                $alerta['stock_minimo'] = $fila['stock_minimo'];
                $_SESSION['alertas'][] = $alerta;
            }
        } else {
            echo '<label id="respuesta_servidor" class="notificacion">
            Todos los productos cuentan con stock suficiente.
            </label>';
        }
    }
    if(isset($_SESSION['alertas']) && !empty($_SESSION['alertas'])) {
        echo '<ul>';
        foreach($_SESSION['alertas'] as $alerta) {
            echo '
            <li class="mensaje">
                <a> Quedan s&oacute;lo ' . $alerta['stock'] . ' unidades de ' . $alerta['nombre'] . ' (Código ' . $alerta['ID_producto'] . '). Mínimo ' . $alerta['stock_minimo'] . '</a>
            </li>';
        }
        echo '</ul>';
    }
    ?>
</div>
<div id='ordenador'>
    <form id='ordenador_form'>
        <?php
        if (isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
            $ordenar_por = $_SESSION['ordenar_por'];
            echo '<select name="ordenar_por" id="ordenar_por">';

            echo '<option value="porcentaje"';
            if ($ordenar_por === 'porcentaje')
                echo 'selected';
            echo '>Porcentaje</option>';

            echo '<option value="fecha"';
            if ($ordenar_por === 'fecha')
                echo ' selected';
            echo '>Fecha de creaci&oacute;n</option>';

            echo '<option value="fecha_expiracion"';
            if ($ordenar_por === 'fecha_expiracion')
                echo ' selected';
            echo '>Expiraci&oacute;n</option>';

            echo '<option value="estado"';
            if ($ordenar_por === 'estado')
                echo ' selected';
            echo '>Estado</option>';

            echo '</select>';
        } else {
            echo '<select name="ordenar_por" id="ordenar_por">
            <option value="porcentaje">Porcentaje</option>
            <option value="fecha">Fecha de creaci&oacute;n</option>
            <option value="fecha_expiracion">Expiraci&oacute;n</option>
            </select>';
        }
        if (isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
            $orden_preferido = $_SESSION['orden_preferido'];
            echo '<select name="orden_preferido" id="orden_preferido">';

            echo '<option value="ASC"';
            if ($orden_preferido === 'ASC') {
                echo ' selected';
            }
            echo '>Ascendente</option>';

            echo '<option value="DESC"';
            if ($orden_preferido === 'DESC') {
                echo ' selected';
            }
            echo '>Descendente</option>';

            echo '</select>';
        } else {
            echo '<select name="orden_preferido" id="orden_preferido">
            <option value="ASC">Ascendente</option>
            <option value="DESC">Descendente</option>
            </select>';
        }
        echo '<img id="ocultar_ordenador" src="../iconos/filter-3.svg">';
        ?>
    </form>
</div>
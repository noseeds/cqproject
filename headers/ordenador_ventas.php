<div id="ordenador">
    <form id="ordenador_form">
        <?php
        if (isset($_SESSION["ordenar_por"]) && !empty($_SESSION["ordenar_por"])) {
            $ordenar_por = $_SESSION["ordenar_por"];
            echo "<select name='ordenar_por' id='ordenar_por'>";

            echo "<option value='fecha'";
            if ($ordenar_por === "fecha")
                echo "selected";
            echo ">Fecha</option>";

            echo "<option value='valor'";
            if ($ordenar_por === "valor")
                echo " selected";
            echo ">Valor total</option>";

            echo "<option value='tipo'";
            if ($ordenar_por === "tipo")
                echo " selected";
            echo ">Ingreso/egreso</option>";

            echo "</select>";
        } else {
            echo "<select name='ordenar_por' id='ordenar_por'>
            <option value='fecha'>Fecha</option>
            <option value='valor'>Valor total</option>
            <option value='tipo'>Ingreso/egreso</option>
            </select>";
        }
        if (isset($_SESSION["orden_preferido"]) && !empty($_SESSION["orden_preferido"])) {
            $orden_preferido = $_SESSION["orden_preferido"];
            echo "<select name='orden_preferido' id='orden_preferido'>";

            echo "<option value='ASC'";
            if ($orden_preferido === "ASC") {
                echo " selected";
            }
            echo ">Ascendente</option>";

            echo "<option value='DESC'";
            if ($orden_preferido === "DESC") {
                echo " selected";
            }
            echo ">Descendente</option>";

            echo "</select>";
        } else {
            echo "<select name='orden_preferido' id='orden_preferido'>
            <option value='ASC'>Ascendente</option>
            <option value='DESC'>Descendente</option>
            </select>";
        }
        echo '<img id="ocultar_ordenador" src="../iconos/filter-3.svg">';
        ?>
    </form>
</div>
<div id="ordenador">
    <form id="ordenador_form">
        <?php
        if (isset($_SESSION["ordenar_por"]) && !empty($_SESSION["ordenar_por"])) {
            $ordenar_por = $_SESSION["ordenar_por"];
            echo "<select name='ordenar_por' id='ordenar_por'>";

            echo "<option value='nombre'";
            if ($ordenar_por == "nombre")
                echo "selected";
            echo ">nombre</option>";

            echo "<option value='descripcion'";
            if ($ordenar_por == "descripcion")
                echo " selected";
            echo ">descripcion</option>";

            echo "<option value='categoria'";
            if ($ordenar_por == "categoria")
                echo " selected";
            echo ">categoria</option>";

            echo "<option value='precio'";
            if ($ordenar_por == "precio")
                echo " selected";
            echo ">precio</option>";

            echo "<option value='stock'";
            if ($ordenar_por == "stock")
                echo " selected";
            echo ">stock</option>";

            echo "</select>";
        } else {
            echo "<select name='ordenar_por' id='ordenar_por'>
            <option value='nombre'>nombre</option>
            <option value='descripcion'>descripcion</option>
            <option value='categoria'>categoria</option>
            </select>";
        }
        if (isset($_SESSION["orden_preferido"]) && !empty($_SESSION["orden_preferido"])) {
            $orden_preferido = $_SESSION["orden_preferido"];
            echo "<select name='orden_preferido' id='orden_preferido'>";

            echo "<option value='ASC'";
            if ($orden_preferido == "ASC") {
                echo " selected";
            }
            echo ">Ascendente</option>";

            echo "<option value='DESC'";
            if ($orden_preferido == "DESC") {
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
        echo '<img src="../iconos/filter-3.svg">'; /*onclick="' . "$('#ordenador_form select').hide()" . '"*/
        ?>
    </form>
</div>
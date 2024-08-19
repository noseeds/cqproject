<?php
include "include/header.php";
?>
<article id="transacciones">
    <table>    
        <tr class="venta">
            <td class="col1">
                <img src="./iconos/money-dollar-circle.svg">
            </td>
            <td class="col2">
                <p><b>Venta</b></p>
                <a href="ventas.php">productos</a>
            </td>
            <td class="col3">
                <br><p><b>$1000</b></p>
            </td>
        </tr>
        <tr class="egreso">
            <td class="col1">
                <img src="./iconos/money-dollar-circle.svg">
            </td>
            <td class="col2">
                <p><b>Egreso</b></p>
                <p>Compra mercadería</p>
            </td>
            <td class="col3">
                <br><p><b>$1000 </b></p>
            </td>
        </tr>
        <?php
            include 'php/conexion.php';
            if(!$conn){
                die("error de conexion con la base de datos");
            }
            $instruccion = "SELECT v.ID_venta AS ID, 'venta' AS tipo, v.valor AS valor, d.fecha AS fecha, p.nombre AS descripcion FROM ventas v JOIN detalles_venta d ON v.ID_venta = d.ID_venta JOIN productos p ON d.ID_producto=p.ID_producto UNION ALL SELECT g.ID_gasto AS ID, 'egreso' AS tipo, g.valor AS valor, g.fecha AS fecha, g.motivo AS descripcion FROM gastos g ORDER BY fecha DESC";
            $resultado = mysqli_query($conn, $instruccion);
            while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                $ID=$fila['ID'];
                $tipo=$fila['tipo'];
                $valor=$fila['valor'];
                $fecha=$fila['fecha'];
                $descripcion=$fila['descripcion'];
                echo '<tr class="'.$tipo.'">';
                echo '<td class="col1"><img src="./iconos/money-dollar-circle.svg"></td>';
                echo '<td class="col2">
                <p><b>'.ucfirst($tipo).'</b></p>
                <a href="php/detallesventa.php&ID='.$ID.'">'.$descripcion.'</a></td>';
                echo '<td class="col3">
                <br><p><b>'.$fecha.'</b></p>
            </td>';
                echo '<td class="col4">
                <br><p><b>$'.$valor.'</b></p>
            </td>';
                echo '</tr>';
            }           
        ?>
    </table>
</article>
<article id="interfaces">
    <a href="gestor_productos"> Productos </a>
</article>
</body>
</html>
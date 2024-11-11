<?php
require '../backend/comprobar_usuario_administrador.php';
require '../backend/conexion.php';
require '../headers/header_interfaces.php';
include '../headers/ordenador_descuentos.php';
?>
</header>
<h1> Historial de Descuentos </h1>
<article>
    <?php

    $atributo = 'fecha';
    $orden = 'DESC';
    if(isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
        $atributo = $_SESSION['ordenar_por'];
    }
    if(isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
        $orden = $_SESSION['orden_preferido'];
    }

    $instruccion = 'SELECT
        ID_descuento,
        porcentaje,
        fecha,
        fecha_expiracion,
        CASE
            WHEN fecha_expiracion > CURDATE()
            THEN "activo"
            ELSE "inactivo"
        END AS estado,
        activo
        FROM descuentos
        ORDER BY activo DESC, ' . $atributo . ' ' . $orden
    ;
    $resultado = mysqli_query($conn, $instruccion);

    echo '<table id="tabla_registros">
        <thead>
            <tr>
                <th>ID</th>
                <th>Porcentaje</th>
                <th>Fecha</th>
                <th>Expira</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
    <tbody>';
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_descuento = $fila['ID_descuento'];
        $porcentaje = $fila['porcentaje'];
        $fecha = $fila['fecha'];
        $fecha_expiracion = $fila['fecha_expiracion'];
        $estado = $fila['estado'];
        $activo = $fila['activo'];
        if($estado === 'inactivo' && $activo == 1) {
            Header('Location: ../backend/desactivar_descuento.php?expirado=' . $estado . 'a' . $activo . 'a' . $ID_descuento . '&&descuento=' . $ID_descuento);
            $activo = 0;
        }
        echo '
            <tr>
                <td>' . $ID_descuento . '</td>
                <td>' . $porcentaje . '</td>
                <td>' . $fecha . '</td>';
        $fecha_hora_actual = new DateTime();
        $fecha_hora_expiracion = DateTime::createFromFormat('Y-m-d H:i:s', $fecha_expiracion);
        if($fecha_hora_expiracion < $fecha_hora_actual) {
            echo '<td style="color:red;">';
        } else {
            echo '<td>';
        }
        echo $fecha_expiracion . '</td>
                <td>';
        if ($activo == 1) {
            echo 'activo';
        } else {
            echo 'inactivo';
        }
        echo '  </td>
                <td id="' . $ID_descuento . '" class="tabla_registros_celda tabla_registros_opciones">';
                if($activo == 1)
                {
                    echo '<a class="desactivar_descuento"><img src="../iconos/line/checkbox-indeterminate-line.svg"></a>';
                } else {
                    echo '<a class="activar_descuento"><img src="../iconos/checkbox-indeterminate-fill.svg"></a>';
                }
                echo '
                </td>
            </tr>
                ';

    }
    mysqli_free_result($resultado);
    ?>
        </tbody>
    </table>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
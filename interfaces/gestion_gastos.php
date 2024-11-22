<?php
require '../backend/comprobar_usuario_administrador.php';
require '../headers/header_interfaces.php';
require '../backend/conexion.php';
include '../headers/ordenador_transacciones.php';

?>
</header>
<h1> Egresos </h1>
<article id='articulo_gastos'>
    <?php

    $atributo = 'fecha';
    $orden = 'DESC';
    if(isset($_SESSION['ordenar_por']) && !empty($_SESSION['ordenar_por'])) {
        $atributo = $_SESSION['ordenar_por'];
    }
    if(isset($_SESSION['orden_preferido']) && !empty($_SESSION['orden_preferido'])) {
        $orden = $_SESSION['orden_preferido'];
    }

    $instruccion = 'SELECT g.ID_usuario AS ID_usuario, u.nombre AS nombre_usuario, g.ID_gasto AS ID_gasto, g.motivo AS motivo, g.valor AS valor, g.fecha AS fecha FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario ORDER BY ' . $atributo . ' ' . $orden;
    $resultado = mysqli_query($conn, $instruccion);

    echo '<table id="tabla_registros">
        <thead>
            <tr>
                <th>Codigo egreso</th>
                <th>ID Usuario</th>
                <th>Usuario</th>
                <th>Valor</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>';
    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $ID_gasto = $fila['ID_gasto'];
        $ID_usuario = $fila['ID_usuario'];
        $nombre_usuario = $fila['nombre_usuario'];
        $valor = number_format($fila['valor'], 2, ',', '.');
        $motivo = $fila['motivo'];
        $fecha = $fila['fecha'];
        echo '
            <tr>
                <td>' . $ID_gasto . '</td>
                <td>' . $ID_usuario . '</td>
                <td>' . $nombre_usuario . '</td>
                <td>' . $valor . '</td>
                <td>' . $motivo . '</td>
                <td>' . $fecha . '</td>
                <td id="' . $ID_gasto . '" class="tabla_registros_celda tabla_registros_opciones">
                    <a class="editar_gasto">
                        <img src="../iconos/edit-2.svg">
                    </a>
                    <a class="eliminar_gasto">
                        <img src="../iconos/line/checkbox-indeterminate-line.svg">
                    </a>
                </td>
            </tr>';
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
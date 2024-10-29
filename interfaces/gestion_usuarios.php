<?php
require '../backend/comprobar_usuario_administrador.php';
require '../backend/conexion.php';
require '../headers/header_interfaces.php';
include '../headers/ordenador_usuarios.php';
?>
</header>
<h1> Gestionar usuarios</h1>

<article>
    <table id='tabla_registros'>
        <thead>
            <tr>
                <th> ID</th>
                <th> Nombre</th>
                <th> Tipo</th>
                <th> Estado</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $instruccion = 'SELECT * FROM usuarios ORDER BY activo DESC';
            if ($resultado = mysqli_query($conn, $instruccion)) {
                while ($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                    $ID_usuario = $fila['ID_usuario'];
                    $nombre = $fila['nombre'];
                    $tipo = $fila['tipo'];
                    $activo = $fila['activo'];
                    $activo_string = $activo == 1 ? 'Activo' : 'Inactivo';
                    echo '
                        <tr>
                            <td> ' . $ID_usuario . '</td>
                            <td> ' . $nombre . '</td>
                            <td> ' . $tipo . '</td>
                            <td> ' . $activo_string . '</td>
                            <td id="' . $ID_usuario . '" class="tabla_registros_celda tabla_registros_opciones">
                            ';
                    if ($activo == 1) {
                        echo '<a class="desactivar_usuario"><img src="../iconos/line/checkbox-indeterminate-line.svg"></a>';
                    } else {
                        echo '<a class="activar_usuario"><img src="../iconos/checkbox-indeterminate-fill.svg"></a>';
                    }
                    echo '
                    </td>
                    </tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='../menu_usuarios.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
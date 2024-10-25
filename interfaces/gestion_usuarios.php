<?php
require '../backend/conexion.php';
require '../headers/header_interfaces.php';
include '../headers/ordenador_productos.php';
?>
</header>
<h1> Gestionar usuarios</h1>

<article>
    <table class='tabla_registros'>
        <thead>
            <tr>
                <th> ID</th>
                <th> Nombre</th>
                <th> Tipo</th>
                <th> Activo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $instruccion = 'SELECT * FROM usuarios';
                if($resultado = mysqli_query($conn, $instruccion)) {
                    while($fila = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                        $ID_usuario = $fila['ID_usuario'];
                        $nombre = $fila['nombre'];
                        $tipo = $fila['tipo'];
                        $activo = $fila['activo'];
                        $activo = $activo==1?'Activo':'Inactivo';
                        echo '
                        <tr>
                            <td> ' . $ID_usuario . '</td>
                            <td> ' . $nombre . '</td>
                            <td> ' . $tipo . '</td>
                            <td> ' . $activo . '</td>
                        </tr>';
                    }
                }
            ?>
        </tbody>
    </table>
</article>
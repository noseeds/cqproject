<?php
    require '../backend/comprobar_usuario_administrador.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';

    if(isset($_GET['gasto']) && !empty($_GET['gasto'])) {
        $_SESSION['gasto'] = $_GET['gasto'];
    }
?>
</header>
<div id='ordenador_productos'>
</div>
<h1> Modificar Datos de Egreso</h1>

<article>
    <?php
        $instruccion = 'SELECT g.ID_gasto AS ID_gasto, g.valor AS valor, g.motivo AS motivo, g.fecha AS fecha, g.ID_usuario AS ID_usuario, u.nombre AS nombre_usuario FROM gastos g JOIN usuarios u ON g.ID_usuario = u.ID_usuario WHERE ID_gasto =' . $_SESSION['gasto'];
        $resultado = mysqli_query($conn, $instruccion);
        if($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $ID_gasto = $fila['ID_gasto'];
            $valor = $fila['valor'];
            $motivo = $fila['motivo'];
            $fecha = $fila['fecha'];
            $ID_usuario = $fila['ID_usuario'];
            $nombre_usuario = $fila['nombre_usuario'];
        }
    ?>
    <h2> Detalles: </h2>
    <p> Código de egreso:<?php echo ' ' . $ID_gasto; ?> </p>
    <p> Ingresado por usuario<?php echo " '" . $nombre_usuario . "'";?> </p>
    <p> ID de usuario:<?php echo " " . $ID_usuario;?> </p>
    <p> Fecha y hora:<?php echo " " . $fecha;?> </p>
    <form id='formulario_gasto' action='../backend/actualizar_gasto.php' method='POST'>

        <label for='valor'> Valor:</label>
        <?php echo "<input type='number' name='valor' min='1' value='$valor'>" ?>
        <label for='motivo'> Motivo/descripci&oacute;n</label>
        <?php echo "<input type='text' name='motivo' value='$motivo'>" ?>
        <?php
            echo '<input id="ID_usuario" type="hidden" name="usuario" value="';
            echo $_SESSION['ID_usuario'];
            echo '">';
        ?>

        <div class='opciones_interfaz'>
            <button id='boton_cancelar' class='boton' type='button'> Cancelar</button>
            <button id='boton_guardar' class='boton' type='submit'> Guardar</button>
        </div>

        <?php
            echo '<label id="respuesta_servidor"';
            if(isset($_GET['notificacion'])){
                echo ' class="notificacion">';
                echo $_GET['notificacion'];
            } else if(isset($_GET['advertencia'])){
                echo ' class="advertencia">';
                echo $_GET['advertencia'];
            }
            echo '</label>';
        ?>
    </form>
    <picture>
        <source media='(min-width: 48rem)' srcset='../img/regresar_largo.png'>
        <source media='(max-width: 48rem)' srcset='../img/regresar.png'>
        <img class='regresar' data-destino='./gestion_gastos.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
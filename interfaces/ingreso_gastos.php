<?php
    require '../backend/comprobar_usuario.php';
    require '../headers/header_interfaces.php';
    require '../backend/conexion.php';
    include '../headers/ordenador_transacciones.php';
?>
</header>
<div id='ordenador_productos'>
</div>
<h1> Registrar un Egreso</h1>

<article>
    <h2> Detalles: </h2>
    <form id='formulario_gasto' action='../backend/cargar_gasto.php' method='POST'>
        <label for='valor'> Valor:</label>
        <input type='number' name='valor' min='1' value=''>
        <label for='motivo'> Motivo/descripci&oacute;n</label>
        <input type='text' name='motivo'>
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
        <img class='regresar' data-destino='../menu_empresa.php' src='../img/regresar_largo.png' alt='regresar'>
    </picture>
</article>
</body>

</html>
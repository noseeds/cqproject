<?php
include '../headers/header_registros.php';
include '../backend/conexion.php';
            if(!$conn){
                die("error de conexion con la base de datos");
            }           
            $instruccion = "SELECT v.ID_venta AS IDv, v.valor AS valor, d.fecha AS fecha, p.nombre AS descripcion FROM ventas v JOIN detalles_venta d ON v.ID_venta = d.ID_venta JOIN productos p ON d.ID_producto=p.ID_producto ";   
            $resultado = mysqli_query($conn, $instruccion);
            $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC); 
                $ID = $_GET['ID'];  
                $valor=$fila['valor'];
                $nombre=$fila['descripcion'];
                $fecha=$fila['fecha'];
                echo '<p>'.$ID.' '.$valor.' '.$nombre.' '.$fecha.'</p>';
        ?>

</body>
</html>
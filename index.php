<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Mimos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- Seccion superior de la aplicación -->
    <div id="Navegacion" class="fixed, z2">
        <div  id="barraNav">
            <a href="index.html" class="boton, icono"><img src="iconos/menu.svg"></a>   
            <a href="index.html" class="boton, icono"><img src="iconos/bar-chart-2.svg"></a>
            <a href="index.html" class="boton, icono"><img src="iconos/account-circle.svg"></a>
            <a href="index.html" class="boton, icono" ><img src="iconos/add-circle.svg"></a>         
        </div>
        <div  id="Herramientas">
            <img src="" alt="">
            <img src="" alt="">
            <img src="" alt="">
        </div>
        
        <div  id="BusquedaCat">
        
        </div>
    </div>
    <!-- Sección inferior de la aplicación -->
    <div id="transacciones">
        
    </div>
   
    <!-- Ventana emergente del login -->
    <div id="loginRegistro" class="loginRegistro"> 
        <div id="login" class="login">
            <form action="#" method="post">
                <h2>Login</h2>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <div id="registro" class="registro, z5">
            <form action="#" method="post">
                <h2>Registro</h2>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required>
                <input type="email" placeholder="Correo electrónico" name="correo" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>

<?php
function conexion (){
    $conexion = mysqli_connect("localhost", "root", "", "petsmimos");

    if(mysqli_connect_error()){
        echo "No se pudo conectar a la base de datos";
    }
    if($result=mysqli_query($conexion, "SELECT * FROM Usuario")){
        echo "Returned rows are:" . mysqli_num_rows($result);
        mysqli_free_result($result);
    }
    return $conexion;
}
function probar()
{
    $con = conexion();
}

probar();
?>

</html>
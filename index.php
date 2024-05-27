
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
    <div id="navegacion" class="fixed, z2">
        <div  id="barraNav">
            <a href="" class="boton, icono"><img src="iconos/menu.svg"></a>   
            <a href="" class="boton, icono"><img src="iconos/bar-chart-2.svg"></a>
            <a href="" class="boton, icono"><img src="iconos/account-circle.svg"></a>
            <a href="" class="boton, icono" ><img src="iconos/add-circle.svg"></a>         
        </div>
        <div  id="herramientas">
            <img src="" alt="">
            <img src="" alt="">
            <img src="" alt="">
        </div>
        
        <div  id="busquedaCat">
        
        </div>
    </div>
    <!-- Sección inferior de la aplicación -->
    <div id="transacciones" class="">
        <p>a</p>
        <p>a</p>
        <p>a</p>
        <p>a</p>
        <p>a</p>
        <p>a</p>
        <p>a</p>
    </div>
    <!-- Ventana emergente del login y registro -->
    <div id="loginRegistro" class="loginRegistro"> 
        <div id="login" class="login">
            <form action="login.php" method="post">
                <h2>Inicio de sesión</h2>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button id="ingresar" type="submit">Ingresar</button>
            </form>
            <p> ¿No tienes cuenta?</p>
            <a id="cambiarARegistro" class="cambiarARegistro">Registrate</a>
        </div>
        <div id="registro" class="registro z5">
            <form action="registrar.php" id="formularioRegistro" method="post">
                <h2>Registro</h2>
                <input type="number" placeholder="Cédula de identidad" name="cedula" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <input type="password" placeholder="Confirmar contraseña" name="contrasena2" required>
                <button id="registrar" type="submit"> Registrar </button>
            </form>
            <label id="respuestaServidor" style="color: rgba(255,0,0,0.8);"></label>
        </div>
    </div>
    
<script src="jquery-3.7.1.min.js"></script>
<script src="js/script.js" type="application/javascript"></script>


</body>

    <!-- El php😴😴😴😴😴😴😴 a -->

</html>
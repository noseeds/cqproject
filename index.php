
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Mimos</title>
    <link rel="stylesheet" href="css/style.css">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>
<body>
    
    <!-- Seccion superior de la aplicación -->
    <div id="navegacion" class="fixed, z2">
        <div  id="barra_nav">
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
    <div id="login_registro" class="login_registro"> 
        <div id="login" class="login">
            <form action="login.php" method="POST">
                <h2>Iniciar sesión</h2>
                <input type="text" placeholder="Documento de indentificación" name="lcedula" required>
                <label for="lcedula">sin puntos ni guiones</label>
                <input type="password" placeholder="Contraseña" name="lpassword" required>
                <button id="ingresar" type="submit">Acceder</button>
            </form>
            <p><b> ¿No tenés cuenta? </b></p>
            <a id="cambiar_a_registro" class="cambiar_a_registro">Registrate</a>
        </div>
        <div id="registro" class="registro z5">
            <form method="POST" action="registrar.php" id="formulario_registro" >
                <h2>Registro</h2>
                <input type="number" placeholder="Documento de indentificación" name="cedula" required>
                <input type="password" placeholder="Contraseña" name="password" required>
                <label for="password">mínimo 8 carácteres</label>
                <input type="password" placeholder="Confirmar contraseña" name="password2" required>
                <button id="registrar" type="submit"> Registrar </button>
            </form>
            <div id="respuesta_servidor" style="color: rgba(255,0,0,0.8);"></div>
        </div>
    </div>
    
<script src="js/script.js" type="application/javascript"></script>


</body>

    <!-- El php😴😴😴😴😴😴😴 a -->

</html>
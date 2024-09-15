<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

</head>
<body>
<img id="logo" src="logo.png">
<div id="login_registro">
    <div id="login" class="login">
        <form id="formulario_login" action="backend/ingresar.php" method="POST">
            <h2>Iniciar sesión</h2>
            <input type="text" placeholder="Nombre de usuario" name="nombre_login" required>
            <label for="nombre_login"> hasta 16 carácteres</label>
            <input type="password" placeholder="Contraseña" name="contrasena_login" required>
            <div id="alerta_ingreso" style="color: rgba(255,0,0,0.8);">
                <?php
                    if(isset($_GET["advertencia"]) && !empty($_GET["advertencia"]) ){
                        echo "<p style='color: rgb(255,0,0);'>" . $_GET["advertencia"] . "</p>";
                    }
                    if(isset($_GET["notificacion"]) && !empty($_GET["notificacion"]) ){
                        echo "<p style='color: rgb(75,255,0);'>" . $_GET["notificacion"] . "</p>";
                    }
                ?>
            </div>
                <button type="submit" id="ingresar">Acceder</button>
        </form>
        <p><b> ¿No tenés cuenta? </b></p>
        <a class="ingreso_o_registro">Registrarme</a>
    </div>
    <div id="registro" class="registro z5">
        <form id="formulario_registro" action="backend/registrar.php" method="POST">
            <h2>Registro</h2>
            <input type="text" placeholder="Nombre de usuario" name="nombre_registro" required>
            <input type="password" placeholder="Contraseña" name="contrasena_registro" required>
            <label for="contrasena_registro">mínimo 8 carácteres</label>
            <input type="password" placeholder="Confirmar contraseña" name="contrasena_registro2" required>  
            <div id="alerta_registro" style="color: rgba(255,0,0,0.8);">
                <?php
                    if(isset($_GET["advertencia"]) && !empty($_GET["advertencia"])){
                        echo "<p style='color: rgb(255,0,0);'>" . $_GET["advertencia"] . "</p>";
                    }
                    if(isset($_GET["notificacion"])){
                        echo "<p style='color: rgba(75,255,0,0.8);'>";
                        echo $_GET["notificacion"];
                        echo "</p>";
                    }
                ?>
            </div>
            <button type="submit" id="registrar"> Registrar </button>
        </form>
        <a class="ingreso_o_registro">Ya tengo un usuario registrado</a>
    </div>
</div>
    <script src="js/login.js" type="application/javascript"></script>
    <script type="application/javascript">
        let color1='rgba(174, 223, 247) 40%';
        //255, 195, 180
        let colores= [];
        let i=0;
        let e1=60;
        let e2=130;
        let e3=60;
        let body = document.body;
        function generarColores(){
            for(e=0; e<=255; e++){
                if(e%2==0){
                    e1--;
                    e2++;
                    e3++;
                }
                colores.push("rgb("+225+","+e2+","+e1+")"+" "+e3+"%");
            }
            for(e=255; e>=0; e--){
                if(e%2==0){
                    e1++;
                    e2--;
                    e3--;
                }
                colores.push("rgb("+255+","+e2+","+e1+")"+" "+e3+"%");
            }
        }
        generarColores();
        function actualizarFondo(){
            setTimeout(function update() {
                $(body).css("background-image", "linear-gradient(to bottom right, "+color1+"30%, "+colores[i]+")");
                requestAnimationFrame(actualizarFondo);
                i+=5;
                if(i>510){i=0;};
            }, 1000 / 30); //1 frames por segundo (frames recorridas en 1000ms) ms=milisegundos
        }
        requestAnimationFrame(actualizarFondo);
    </script>
</body>
</html>
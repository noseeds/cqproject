<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="js/script.js" type="application/javascript"></script>
    <script type="application/javascript">
$("#registrar").on("click", function(event){
    event.stopPropagation();
    event.preventDefault();
    $("#formulario_registro").submit();
});

$("#ingresar").on("click", function(event){
    event.stopPropagation();
    event.preventDefault();
    $("#formulario_login").submit();
});
    </script>
</head>
<body class="body">

<div id="login_registro">
    <div id="login" class="login">
        <form id="formulario_login" action="ingresar.php" method="POST">
            <h2>Iniciar sesión</h2>
            <input type="text" placeholder="Documento de indentificación" name="lcedula" required>
            <label for="lcedula">sin puntos ni guiones</label>
            <input type="password" placeholder="Contraseña" name="lpassword" required>                <div id="lrespuesta_servidor" style="color: rgba(255,0,0,0.8);"></div>
                <button id="ingresar" type="submit">Acceder</button>
        </form>
        <p><b> ¿No tenés cuenta? </b></p>
        <a class="registro_o_acceso">Registrarme</a>
    </div>
    <div id="registro" class="registro z5">
        <form id="formulario_registro" action="registrar.php" method="POST" >
            <h2>Registro</h2>
            <input type="number" placeholder="Documento de indentificación" name="cedula" required>
            <input type="password" placeholder="Contraseña" name="password" required>
            <label for="password">mínimo 8 carácteres</label>
            <input type="password" placeholder="Confirmar contraseña" name="password2" required>
            <div id="rrespuesta_servidor" style="color: rgba(255,0,0,0.8);"></div>
            <button id="registrar" type="submit"> Registrar </button>
        </form>
        <a class="registro_o_acceso">Ya tengo un usuario registrado</a>
    </div>
</div>

    <script type="application/javascript">
        let color1='rgba(0,0,0,1) 50%';
        let colores= [];
        let i=0;
        let body = document.body;
        function generarColores(){
            for(e=0; e<=255; e++){
                colores.push("rgb("+50+","+e+","+50+")");
            }
            for(e=255; e>=0; e--){
                colores.push("rgb("+50+","+e+","+50+")");
            }
        }
        generarColores();
        function actualizarFondo(){
            setTimeout(function update() {
                $(body).css("background-image", "linear-gradient(to bottom, "+color1+", "+colores[i]+")");
                requestAnimationFrame(actualizarFondo);
                i++;
                if(i>510){i=0;};
            }, 1000 / 1); //1 frames por segundo (frames recorridas en 1000ms) ms=milisegundos
        }
        requestAnimationFrame(actualizarFondo);
    </script>
</body>
</html>

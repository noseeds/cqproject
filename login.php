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
    <script type="application/javascript">
    $("#formulario_login").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        const formularioData = new FormData(this);
        fetch('ingresar.php',{
            method: 'POST',
            body: formularioData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.redirect) {
                var meta = document.createElement('meta');
                meta.content = '0;url=' + data.redirect;
                document.head.appendChild(meta);
            }/* else {
                        $('#lrespuesta_servidor').html(data.message).css("display", "block").effect( "shake", { direction: "right", times: 3, distance: 4}, 500);
                    }*/
        })
        .catch(error =>{
            console.error('Error:', error);
        });
    });

    $("#formulario_registro").on("submit", function(event){
        event.stopPropagation();
        event.preventDefault();
        const formularioData = new FormData(this);
        fetch('registrar.php',{
            method: 'POST',
            body: formularioData
        })
        .then(response => response.json())
        .then(data => {
            $("#rrespuesta_servidor").html("")
            if (data.status === 'success' && data.redirect) {
                var meta = document.createElement('meta');
                meta.content = '0;url=' + data.redirect;
                document.head.appendChild(meta);
            }
            /* else {
                        $('#rrespuesta_servidor').html(data.message).css("display", "block").effect( "shake", { direction: "right", times: 3, distance: 4}, 500);
                    }*/
        })
        .catch(error =>{
            console.error('Error:', error);
        });
    });
</script>
</head>
<body class="body">
<img id="logo" src="logo.png">
<div id="login_registro">
    <div id="login" class="login">
        <form id="formulario_login" action="ingresar.php" method="POST">
            <h2>Iniciar sesión</h2>
            <input type="text" placeholder="Documento de indentificación" name="lcedula" required>
            <label for="lcedula">sin puntos ni guiones</label>
            <input type="password" placeholder="Contraseña" name="lpassword" required>
            <div id="lrespuesta_servidor" style="color: rgba(255,0,0,0.8);">
                <?php
                    if(isset($_GET["advertencia"]) && !empty($_GET["advertencia"])){
                        echo $_GET["advertencia"];
                    }
                ?>
            </div>
                <button id="ingresar">Acceder</button>
        </form>
        <p><b> ¿No tenés cuenta? </b></p>
        <a class="registro_o_acceso">Registrarme</a>
    </div>
    <div id="registro" class="registro z5">
        <form id="formulario_registro" action="registrar.php" method="POST">
            <h2>Registro</h2>
            <input type="number" placeholder="Documento de indentificación" name="cedula" required>
            <input type="password" placeholder="Contraseña" name="password" required>
            <label for="password">mínimo 8 carácteres</label>
            <input type="password" placeholder="Confirmar contraseña" name="password2" required>  
            <div id="rrespuesta_servidor" style="color: rgba(255,0,0,0.8);">
                <?php
                    if(isset($_GET["advertencia"]) && !empty($_GET["advertencia"])){
                        echo $_GET["advertencia"];
                    }
                ?>
            </div>
            <button id="registrar"> Registrar </button>
        </form>
        <a class="registro_o_acceso">Ya tengo un usuario registrado</a>
    </div>
</div>
    <script src="js/script.js" type="application/javascript"></script>
    <script type="application/javascript">
        let color1='rgba(200,200,200,1) 40%';
        let colores= [];
        let i=0;
        let e2=60;
        let body = document.body;
        function generarColores(){
            for(e=0; e<=255; e++){
                if(e%4==0){
                    e2++;
                }
                colores.push("rgb("+255+","+e2+","+e+")"+" "+e2+"%");
            }
            for(e=255; e>=0; e--){
                if(e%4==0){
                    e2--;
                }
                colores.push("rgb("+255+","+e2+","+e+")"+" "+e2+"%");
            }
        }
        generarColores();
        function actualizarFondo(){
            setTimeout(function update() {
                $(body).css("background-image", "linear-gradient(to bottom right, "+color1+", "+colores[i]+")");
                requestAnimationFrame(actualizarFondo);
                i+=5;
                if(i>510){i=0;};
            }, 1000 / 30); //1 frames por segundo (frames recorridas en 1000ms) ms=milisegundos
        }
        requestAnimationFrame(actualizarFondo);
    </script>
</body>
</html>
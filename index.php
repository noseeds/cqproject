
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
            <form action="#" method="post">
                <h2>Inicio de sesión</h2>
                <input type="text" placeholder="Nombre de usuario" name="usuario" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <button id="ingresar" type="submit">Ingresar</button>
            </form>
            <p> ¿No tienes cuenta?</p>
            <a id="cambiarARegistro" class="cambiarARegistro">Registrate</a>
        </div>
        <div id="registro" class="registro z5">
            <form action="#" method="post">
                <h2>Registro</h2>
                <input type="text" placeholder="Cédula de identidad" name="cedula" required>
                <input type="password" placeholder="Contraseña" name="contrasena" required>
                <input type="password" placeholder="Confirmar contraseña" name="contrasena2" required>
                <button id="registrar" type="submit"> Registrar </button>
            </form>
        </div>
    </div>
    
<script src="jquery-3.7.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var loginForm = $("#login");
    var registroForm = $("#registro");
    var cambiarFormulario = $("#cambiarARegistro");
    var ingresar = $("#ingresar");
    var registrar = $("#registrar");

    cambiarFormulario.click(function() {
        if (loginForm.css("display") === "none") {
            loginForm.css("display", "block");
            registroForm.css("display", "none");
            //cambiarFormulario.text("cambiar a registro");
        } else {
            loginForm.css("display", "none");
            registroForm.css("display", "block");
        }
    });

    registrar.click(function() {
        registroForm.hide(175, "swing");
    })
    ingresar.click(function() {
        loginForm.hide(175, "swing");
    })
                                                                                                                                                                                                                  
});  

</script>


</body>

    <!-- El php😴😴😴😴😴😴😴 -->
<?php

echo '';

//Conexion a la base de datos

function conexion (){
    $conexion = mysqli_connect("localhost", "root", "", "petsmimos");

    if(mysqli_connect_error()){
        echo "No se pudo conectar a la base de datos";
    }   
    if($result=mysqli_query($conexion, "SELECT * FROM Usuario")){
        echo "Returned rows are:" . mysqli_num_rows($result);
    }
    return $conexion;
}
function cargarUsuario($cedula, $password)
{
    $con = conexion();
    $resultado = mysqli_query($con, "INSERT INTO Usuario (cedula_usuario, contraseña) VALUES('$cedula', '$password');");
    mysqli_close($con);
}
function borrarUsuario($cedula)
{
    $con = conexion();
    $resultado = mysqli_query($con, "DELETE FROM Usuario WHERE cedula_usuario = '$cedula'");
    mysqli_close($con);
}

borrarUsuario('juam');
cargarUsuario('juam', 'bananabanana');

?>

</html>
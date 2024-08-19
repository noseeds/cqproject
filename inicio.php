<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Mimos</title>
    <link rel="stylesheet" href="css/inicio.css">
    <script src="js/inicio.js"> </script>
</head>
<body>
    <header>
        <img src="img/logo.png" class="logo" alt="logo">
        <nav>
            <a href="#inicio" class="scroll"> Inicio </a>
            <a href="#catalogo" class="scroll"> Catálogo </a>
            <a href="#contacto" class="scroll"> Contacto </a>
            <a href="#sobre_nosotros" class="scroll"> Sobre Nosotros </a>
            <a href="login.php" class="scroll"> Ingreso </a>
        </nav>
    </header>
    <article id="inicio"></article>
    <article id="catalogo">
      <h3>Catálogo</h2>
      <div class="contenedor">
        <div class="productos">
            <div class="slider_productos">
                <img src="img/mochila para gatos.jpg" alt="" id="objeto1">
                <img src="iconos/menu.svg" alt="" id="objeto2">
                <img src="img/mochila para gatos.jpg" alt="" id="objeto3">
                <img src="iconos/menu.svg" alt="" id="objeto4">
                <img src="img/mochila para gatos.jpg" alt="" id="objeto5">
            </div>
            <div class="slider_productos_nav">
                <a href="#objeto1" class="scroll"></a>
                <a href="#objeto2" class="scroll"></a>
                <a href="#objeto3" class="scroll"></a>
                <a href="#objeto4" class="scroll"></a>
                <a href="#objeto5" class="scroll"></a>
            </div>
        </div>
      </div>
    </article>
    <article id="contacto">
        <h3>Contacto</h2>
        <p> <i class="fa fa-whatsapp"  aria-hidden="true"></i>
 098 979 049</p>
        <p> <i class="fa-brands fa-instagram"></i> <a href=""></a></p>
        <div id="mapa" class="mostrar">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d425.7462065642846!2d-57.965512!3d-31.3874003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95addd7e4399f187%3A0x87011f7244001591!2sPets%20Mimos!5e0!3m2!1ses-419!2suy!4v1710715394767!5m2!1ses-419!2suy" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%"></iframe>
        </div>
        <img id="iconoMapa" class="icono, desplegar" src="iconos/map-pin-2.svg" alt="" display="none">
    </article>
    <article id="sobre_nosotros">
        
    </article>
    <article><h3>Sobre nosotros</h2></article>
    <footer>Pets Mimos © 2024</footer>
</body>
</html>

// Volver hasta el comienzo de la página
$('#volverArriba').on('click', function(){
  $('html, body').animate({scrollTop: 0}, 300);
  setTimeout(function() {
    $('#volverArriba').css({
      'background-color':'rgba(0,0,0,0)',
      '-webkit-transform':'scaleY(-1)',
      'transform':'scaleY(-1)'});
  }, 300);
});
//hover desde js
$('#volverArriba').on('mouseenter', function()
{
  $('#volverArriba').css({'background-color': 'rgba(255,255,255,0.6)',
    'border-radius': '5px',
    '-webkit-transform': 'scaleY(1)',
    'transform': 'scaleY(1)'});
});

//setear elementos al cargar la pagina
window.onload = function()
{
  $(document).scrollTop = 0;
  $(document).ready();
  alturaClientePS = $('#parteSuperior').height();
  $('#registro').css('top', alturaClientePS + 'px');
  $('volverArriba').css('top', alturaClientePS + 'px');
}
//event listener de cuando se scrollea en la pagina
$(window).scroll(function() {
  var posicionScroll = $(this).scrollTop();
  if (posicionScroll > 35) {
    $('#volverArriba').css('display', 'block');
  } else {
    $('#volverArriba').css('display', 'none');
  }
});

//cargar las transacciones (pronto)

//insertar elementos del catalogo
//dentro de un elemento de id catalogo
//usando un documento de texto
//que contiene las etiquetas html
//lo vamos a usar cuando creemos las diferentes secciones de la app
function cargarCatalogo()
{
  var catalogo = document.querySelector("#catalogo");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
   document.getElementById("catalogo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "catalogo.txt", true);
  xhttp.send();
}

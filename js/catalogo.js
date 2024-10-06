$(document).ready(function (){
    $('#visor_producto').css('display', 'none');

    $('.producto').on('click', function () {
        $nombre_producto = $(this).children('img').data('nombre');
        $precio_producto = $(this).children('img').data('precio');
        $descripcion_producto = $(this).children('img').data('descripcion');

        $nombre = $('<h2>').text($nombre_producto);
        $precio = $('<h3>').text($precio_producto);
        $descripcion = $('<p>').text($descripcion_producto);

        $('#visor_producto').html('');
        $('#visor_producto').append($nombre);
        $('#visor_producto').append($precio);
        $('#visor_producto').append($descripcion);
        $('#visor_producto').css('display', 'flex');
    });
});
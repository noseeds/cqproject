function ajustar_scroll() {
    $hash = window.location.hash;
    $objeto = $($hash);

    if ($objeto.length) {
        $posicion_objeto = $objeto.offset().top;
        $altura_ventana = $(window).height();
        $altura_objeto = $objeto.outerHeight();
        $posicion_objeto = $posicion_objeto - ($altura_ventana / 2) + ($altura_objeto / 2);
        $('html, body').animate({
            scrollTop: $posicion_objeto
        }, 0);
    }
}
$(document).ready(function () {
    $('#visor_producto').css('display', 'none');

    $('.producto').on('mouseover click', function () {
        $nombre_producto = $(this).children('img').data('nombre');
        $precio_producto = $(this).children('img').data('precio');
        $descripcion_producto = $(this).children('img').data('descripcion');

        $nombre = $('<h2>').text($nombre_producto);
        $precio = $('<p>').text('$' + $precio_producto);
        $descripcion = $('<p>').text($descripcion_producto);

        $('#visor_producto').html('<h2> Estás viendo: </2>');
        $('#visor_producto').append($nombre);
        $('#visor_producto').append($precio);
        $('#visor_producto').append($descripcion);
        $('#visor_producto').css('display', 'flex');
    });
    $('#visor_producto').on('click', function () {
        $(this).css('display', 'none');
    });

    function destacar_producto() {
        $('.producto_img').each(function () {
            if ($(this).attr('id') == window.location.hash.substring(1)) {
                $(this).css('border', '0.2rem solid rgba(155, 255, 0, 1)');
                $(this).css('box-shadow', '0 0 0.6rem 0.6rem rgba(175, 255, 0, 0.7)');
                $(this).css('transition', 'box-shadow 0.3s ease-in-out');
            } else {
                $(this).css('border', '');
                $(this).css('box-shadow', '');
                $(this).css('transition', '');
            }
        });
    }

    $productos = [];
    $mayor_id_productos = 1;
    $menor_id_productos = 1;
    $('.producto_img').each(function () {
        $productos.push($(this).attr('id'));
    });
    $cantidad_productos = $productos.length;
    window.location.hash = $productos[0];
    destacar_producto();

    $('#siguiente_producto').on('click', function () {
        //obtener el id de hash. Substring(1) toma el string a partir del segundo caracter (el primer caracter es indice 0).
        $hash_actual = window.location.hash.substring(1);
        if (isNaN($hash_actual) || $hash_actual === '') {
        }
        $hash_nuevo = $hash_actual;
        for ($i = 0; $i < $cantidad_productos; $i++) {
            if ($hash_actual == $productos[$i] && $i != ($cantidad_productos - 1)) {
                $hash_nuevo = $productos[($i + 1)];
            } else if ($hash_actual == $productos[($cantidad_productos - 1)]) {
                $hash_nuevo = $productos[0];
            }
        }
        //usar jquery para cambiar el hash (no recarga la página)
        window.location.hash = $hash_nuevo;
        destacar_producto();
    });
    $('#anterior_producto').on('click', function () {
        $hash_actual = window.location.hash.substring(1);
        if (isNaN($hash_actual) || $hash_actual === '') {
        }
        $hash_nuevo = $hash_actual;

        $cantidad_productos = $productos.length;
        for ($i = 0; $i < $cantidad_productos; $i++) {
            if ($hash_actual == $productos[$i] && $i != 0) {
                $hash_nuevo = $productos[($i - 1)];
            } else if ($hash_actual == $productos[0]) {
                $hash_nuevo = $productos[$cantidad_productos - 1];
            }
        }
        window.location.hash = $hash_nuevo;
        destacar_producto();
    });
    ajustar_scroll();
    $('#anterior_producto, #siguiente_producto').on('click', ajustar_scroll);

    $indice_banner = 0;
    $banners = $('#slider_banner img');
    $total_banners = $banners.length;

    $($banners[$indice_banner]).addClass('active');

    function cambiar_banner($i) {
        $banners.removeClass('active').fadeOut();
        $($banners[$i]).addClass('active').fadeIn();
    }

    setInterval(function () {
        $indice_banner = ($indice_banner + 1) % $total_banners;
        cambiar_banner($indice_banner);
    }, 3000);
});

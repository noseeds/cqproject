$(document).ready(function (){
    $('#visor_producto').css('display', 'none');

    $('.producto').on('mouseover click', function () {
        $nombre_producto = $(this).children('img').data('nombre');
        $precio_producto = $(this).children('img').data('precio');
        $descripcion_producto = $(this).children('img').data('descripcion');

        $nombre = $('<h2>').text($nombre_producto);
        $precio = $('<p>').text('$'+$precio_producto);
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
        $('.producto_img').each( function (){
            if($(this).attr('id') == window.location.hash.substring(1)){
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
    $('.producto_img').each(function (){
        $productos.push($(this).attr('id'));
        console.log($(this));
    });
    $cantidad_productos = $productos.length;
    window.location.hash = $productos[0];
    destacar_producto();

    $('#siguiente_producto').on('click', function () {
        //obtener el id de hash. Substring(1) toma el string a partir del segundo caracter (el primer caracter es indice 0).
        $hash_actual = window.location.hash.substring(1);
        if(isNaN($hash_actual) || $hash_actual === '') {
        }
        $hash_nuevo = $hash_actual;
        for($i=0; $i < $cantidad_productos; $i++) {
            if($hash_actual == $productos[$i] && $i != ($cantidad_productos-1)) {
                $hash_nuevo = $productos[($i+1)];
            } else if ($hash_actual == $productos[($cantidad_productos-1)]) {
                $hash_nuevo = $productos[0];
            }
            console.log($hash_nuevo);
        }
        //usar jquery para cambiar el hash (no recarga la página)
        window.location.hash = $hash_nuevo;
        destacar_producto();
    });
    $('#anterior_producto').on('click', function () {
        $hash_actual = window.location.hash.substring(1);
        if(isNaN($hash_actual) || $hash_actual === '') {
        }
        $hash_nuevo = $hash_actual;

        $cantidad_productos = $productos.length;
        for($i=0; $i < $cantidad_productos; $i++) {
            if($hash_actual == $productos[$i] && $i != 0) {
                $hash_nuevo = $productos[($i-1)];
            } else if ($hash_actual == $productos[0]) {
                $hash_nuevo = $productos[$cantidad_productos-1];
            }
            console.log($hash_nuevo);
        }
        window.location.hash = $hash_nuevo;
        destacar_producto();
    });
});
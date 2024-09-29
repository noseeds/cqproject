function a() {
    $opcion_seleccionada1 = $('#ordenar_por').val();
    $opcion_seleccionada2 = $('#orden_preferido').val();
    $.ajax({
        url: 'backend/actualizar_variables_session.php',
        method: 'POST',
        data: { ordenar_por: $opcion_seleccionada1, orden_preferido: $opcion_seleccionada2 },
        success: function (response) {
            $respuesta = JSON.parse(response);
            console.log('Session variable updated:', response);
            if ($respuesta.estado === 'exito') {
                window.location.reload();
            }
        }
    });
};

$(document).ready(function () {
    $('#subir_imagen').on('change', function (e) {
        const imagen = e.target.files[0];
        $('#formulario_cargar_imagen').submit();
    });
    $('.imagen_seleccionable').on('click', function () {
        $('.imagen_seleccionable').removeClass('seleccionado');
        $(this).addClass('seleccionado');
        const imagen = $(this).data('imagen-id');
        $('#input_imagen_seleccionada').val(imagen);
    });
    $('#ordenar_por').on('change', function () {
        $opcion_seleccionada1 = $('#ordenar_por').val();
        $opcion_seleccionada2 = $('#orden_preferido').val();
        $.ajax({
            url: '../backend/actualizar_variables_session.php',
            method: 'POST',
            data: { ordenar_por: $opcion_seleccionada1, orden_preferido: $opcion_seleccionada2 },
            success: function (response) {
                $respuesta = JSON.parse(response);
                console.log('Session variable updated:', response);
                if ($respuesta.estado === 'exito') {
                    window.location.reload();
                }
            }
        });
    });
    $('#orden_preferido').on('change', function () {
        $opcion_seleccionada1 = $('#ordenar_por').val();
        $opcion_seleccionada2 = $('#orden_preferido').val();
        $.ajax({
            url: '../backend/actualizar_variables_session.php',
            method: 'POST',
            data: { ordenar_por: $opcion_seleccionada1, orden_preferido: $opcion_seleccionada2 },
            success: function (response) {
                $respuesta = JSON.parse(response);
                console.log('Variables de sesi$oacute;n actualizadas:', response);
                if ($respuesta.estado === 'exito') {
                    window.location.reload();
                }
            }
        });
    });
    $('#banner_ingresos').on('click', function () {
        let url = new URL(window.location.href);
        url.searchParams.set('transacciones_a_mostrar', 'ingresos');
        window.location.href = url;
    });
    $('#banner_egresos').on('click', function () {
        let url = new URL(window.location.href);
        url.searchParams.set('transacciones_a_mostrar', 'egresos');
        window.location.href = url;
    });

    $('#formulario_agregar_producto').on('submit', function (event) {
        event.preventDefault();
        $opcion_seleccionada = $('#selector_productos').val();
        $cantidad = $('#cantidad_productos').val();
        $.ajax({
            url: '../backend/actualizar_variables_session.php',
            method: 'POST',
            data: {
                producto_para_agregar: $opcion_seleccionada,
                cantidad: $cantidad,
                success: function (response) {
                    try {
                        $respuesta = JSON.parse(response);
                        console.log('Variables de sesi$oacute;n actualizadas:', response);
                        if ($respuesta.estado === 'exito') {
                            window.location.reload();
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        console.log('Raw response:', response);
                    }
                }
            }
        });
    });
});

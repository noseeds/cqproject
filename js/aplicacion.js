
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

    $('#boton_cancelar').on('click', function () {
        window.location.href = '../aplicacion.php';
    });

    $('#boton_guardar').on('click', function () {
        $('#formulario_venta').submit();
    });

    $('#formulario_codigo').on('submit', function (event) {
        event.preventDefault();
        $datos_formulario = new FormData($('#formulario_codigo')[0]);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $datos_formulario,
            //falso si se envía FormData o archivos, previene que jquery sobreescriba el header content-type
            contentType: false,
            //que los datos no se conviertan en string, dejar en true si se envia texto o json
            processData: false,
            success: function(datos) {
                $('body').append(datos);
                $url = $('#url').val();
                console.log($url);
                navigator.clipboard.writeText($url)
                .then(() => {
                    alert('Enlace copiado al portapapeles, debe enviar este enlace a la persona que desea registrarse como usuario administrador. Compartir este enlace únicamente con personas de confianza. ');
                })
                .catch(error => {
                    console.error('Error al copiar el enlace: ', error);
                });
            },
            error: function(error) {
                console.error('Ocurrió un error, registro no concretado.', error);
            }
        });
    });

    $('.editar_producto').on('click', function () {
        window.location.href = './modificar_producto.php?producto='+$(this).parent().attr('id');
    });
    $('.eliminar_producto').on('click', function () {
        var confirmacion = confirm('¿Seguro? Esta acción no se podrá deshacer');
        if(confirmacion){
            window.location.href = './eliminar_producto.php?producto='+$(this).parent().attr('id');
        }
    });
    $('volver_menu').on('click', function () {
        window.location.href = '../aplicacion.php';
    });
});

function mostrar_imagen(e) {
    $lector = new FileReader();
    $lector.onload = function () {
        $input_imagen = document.getElementById('imagen_previa');
        $input_imagen.src = $lector.result;
        $input_imagen.style.display = 'block';
    };
    $lector.readAsDataURL(e.target.files[0]);
}

$(document).ready(function () {

    $('#subir_imagen').on('change', function (e) {
        mostrar_imagen(e);
        $imagen = e.target.files[0];
        $('#formulario_cargar_imagen').submit();
    });
    $('.imagen_seleccionable').on('click', function () {
        $('.imagen_seleccionable').removeClass('seleccionado');
        $(this).addClass('seleccionado');
        $imagen = $(this).data('imagen-id');
        $('#input_imagen_seleccionada').val($imagen);
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
                console.log('Variables de sesión actualizadas:', response);
                if ($respuesta.estado === 'exito') {
                    window.location.reload();
                }
            }
        });
    });
    $('#metodo_pago').on('change', function () {
        $metodo_seleccionado = $('#metodo_pago').val();
        $.ajax({
            url: '../backend/actualizar_variables_session.php',
            method: 'POST',
            data: { metodo_pago: $metodo_seleccionado },
            success: function (response) {
                $respuesta = JSON.parse(response);
                console.log('Variables de sesión actualizadas:', response);
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
        window.location.href = '../menu.php';
    });

    $('#boton_guardar').on('click', function () {
        if (window.location.href.includes('ingreso_ventas')) {
            $('#formulario_venta').submit();
        }
        if (window.location.href.includes('nuevo_usuario')) {
            $('#formulario_codigo').submit();
        }
        if (window.location.href.includes('ingreso_descuentos')) {
            $('#formulario_descuento').submit();
        }
        if (window.location.href.includes('ingreso_producto')) {
            $('#formulario_producto').submit();
        }
    });

    $('#formulario_codigo').on('submit', function (event) {
        event.preventDefault();
        $datos_formulario = new FormData($('#formulario_codigo')[0]);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $datos_formulario,
            contentType: false,
            processData: false,
            success: function (datos) {
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
            error: function (error) {
                console.error('Ocurrió un error, registro no concretado.', error);
            }
        });
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
            //que los datos no se conviertan en strings, dejar en true si se envia texto o json
            processData: false,
            success: function (datos) {
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
            error: function (error) {
                console.error('Ocurrió un error, registro no concretado.', error);
            }
        });
    });

    $('#ocultar_ordenador').on('click', function () {
        if ($('#ordenador_form select').is(':hidden')) {
            $('#ordenador_form select').show();
            $('#ordenador_form select').css('display', 'flex');

        } else {
            $('#ordenador_form select').hide();
        }
    });
    $('#alertas_restock').hide();
    $('#mostrar_alertas_restock').on('click', function () {
        if ($('#alertas_restock').is(':hidden')) {
            $('#alertas_restock').show();
        } else {
            $('#alertas_restock').hide();
        }
    });
    $('#alertas_restock').on('click', function () {
        $('#alertas_restock').hide();
    });
    $('.editar_producto').on('click', function () {
        window.location.href = './modificar_producto.php?producto=' + $(this).parent().attr('id');
    });
    $('.desactivar_producto').on('click', function () {
        window.location.href = '../backend/desactivar_producto.php?producto=' + $(this).parent().attr('id');
    });
    $('.activar_producto').on('click', function () {
        window.location.href = '../backend/activar_producto.php?producto=' + $(this).parent().attr('id');
    });
    $('.desactivar_usuario').on('click', function () {
        window.location.href = '../backend/desactivar_usuario.php?usuario=' + $(this).parent().attr('id');
    });
    $('.activar_usuario').on('click', function () {
        window.location.href = '../backend/activar_usuario.php?usuario=' + $(this).parent().attr('id');
    });
    $('#volver_menu').on('click', function () {
        window.location.href = '../menu.php';
    });
    $('.editar_gasto').on('click', function () {
        window.location.href = '../interfaces/modificar_gasto.php?gasto=' + $(this).parent().attr('id');
    });
    $('.eliminar_gasto').on('click', function () {
        window.location.href = '../backend/eliminar_gasto.php?gasto=' + $(this).parent().attr('id');
    });
    $('.editar_venta').on('click', function () {
        window.location.href = '../interfaces/modificar_venta.php?venta=' + $(this).parent().attr('id');
    });
    $('.desactivar_venta').on('click', function () {
        window.location.href = '../backend/desactivar_venta.php?venta=' + $(this).parent().attr('id');
    });
    $('.activar_venta').on('click', function () {
        window.location.href = '../backend/activar_venta.php?venta=' + $(this).parent().attr('id');
    });
    $('.desactivar_descuento').on('click', function () {
        window.location.href = '../backend/desactivar_descuento.php?descuento=' + $(this).parent().attr('id');
    });
    $('.activar_descuento').on('click', function () {
        window.location.href = '../backend/activar_descuento.php?descuento=' + $(this).parent().attr('id');
    });
    $('.regresar').on('click', function () {
        $destino = $(this).data('destino');
        window.location.href = $destino;
    });

    function guardar_metodos_pago() {
        var metodos_pago = [];
        var cantidades = [];
        var selects_metodo_pago = $('[name="metodos_pago[]"]');
        var inputs_cantidad = $('[name="cantidades_pago[]"]');
    
        selects_metodo_pago.each(function(index) {
            metodos_pago.push($(this).val());
            cantidades.push($(inputs_cantidad[index]).val());
        });
    
        localStorage.setItem('metodos_pago', JSON.stringify(metodos_pago));
        localStorage.setItem('cantidades_pago', JSON.stringify(cantidades));
    }

    if (window.location.href.includes('ingreso_ventas')) {
        $('#formulario_venta').on('submit', guardar_metodos_pago);
        $contenedor = $('#contenedor_metodos_pago');
        $('#agregar_metodo_pago').on('click', function() {
            $.ajax({
                url: '../backend/obtener_metodos_pago.php',
                type: 'GET',
                success: function(response) {
                    if (response && response.length) {
                        $metodo_pago = $('<div></div>', {
                            class: 'metodo_pago'
                        });
                        $label1 = $('<label> M&eacute;todo de pago:</label>', {
                            for: 'metodos_pago[]'
                        });
                        $select = $('<select></select>', {
                            name: 'metodos_pago[]',
                            html: '<option value="-1">Selecciona metodo de pago</option>'
                        });
                        response.forEach(function(metodo) {
                            $option = $('<option></option>', {
                                value: metodo.ID_metodo_pago,
                                text: metodo.nombre
                            });
                            $select.append($option);
                        });
                        $metodo_pago.append($label1, $select);
                        $label2 = $('<label> Cantidad paga:</label>', {
                            for: 'cantidades_pago[]'
                        });
                        $input = $('<input>', {
                            class: 'cantidades_pagas',
                            type: 'number',
                            name: 'cantidades_pago[]',
                            min: 1,
                            step: 1,
                            value: $('#total').html()
                        });
                        $metodo_pago.append($label2, $input);
                        $contenedor.append($metodo_pago);
                    } else {
                        console.log("No payment methods found.");
                    }
                },
                error: function() {
                    alert("An error occurred while loading the payment methods.");
                }
            });
            alert('New payment method and amount fields added');  // Alert #5
        });
    
        $(window).on('load', function() {
    
            var metodos_pago = JSON.parse(localStorage.getItem('metodos_pago')) || [];
            var cantidades = JSON.parse(localStorage.getItem('cantidades_pago')) || [];
    
            if (metodos_pago.length === 0) {
                alert('No saved payment methods found');  // Alert #7
            } else {
                alert('Saved payment methods found, loading them');  // Alert #8
            }
    
            var contenedor_metodos_pago = $('#metodos_pago_container');
            metodos_pago.forEach(function(metodo, indice) {
                var select = $('<select></select>', {
                    name: 'metodos_pago[]',
                    html: '<option value="' + metodo + '">' + metodo + '</option>'
                });
                var input = $('<input>', {
                    type: 'number',
                    name: 'cantidades_pago[]',
                    value: cantidades[indice]
                });
                contenedor_metodos_pago.append(select, input);
                alert('Loaded saved payment method: ' + metodo + ' with amount: ' + cantidades[indice]);  // Alert #9
            });
        });
    }
});
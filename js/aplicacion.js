$(document).ready(function () {
    $("#subir_imagen").on("change", function (e) {
        const imagen = e.target.files[0];
        $("#formulario_cargar_imagen").submit();
    });
    $('.imagen_seleccionable').on('click', function () {
        $('.imagen_seleccionable').removeClass('seleccionado');
        $(this).addClass('seleccionado');
        const imagen = $(this).data('value');
        $('#input_imagen_seleccionada').val(imagen);
    });
});

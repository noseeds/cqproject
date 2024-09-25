function obtenerVariableGET(nombre, url = window.location.href) {
    // obtiene la parte de la url donde se ubican las variables get
    const variablesGET = window.location.search;
    // crea un objeto que contiene cada variable get por separado
    const urlParams = new URLSearchParams(variablesGET);
    // se agarra el valor de la variable especifica
    const valor = urlParams.get("formulario_actual");
    return(valor);
}

$(document).ready(function () {
    var loginForm = $("#login");
    var registroForm = $("#registro");
    //cambiar de formulario
    $(".ingreso_o_registro").click(function (event) {
        if (loginForm.css("display") === "none") {
            loginForm.css("display", "flex");
            registroForm.css("display", "none");
        } else {
            loginForm.css("display", "none");
            registroForm.css("display", "flex");
        }
    });
    //mostrar el formulario correcto y ocultar el otro
    if (obtenerVariableGET("formulario_actual") === "registro") {
        loginForm.css("display", "none");
        registroForm.css("display", "flex");
    } else {
        loginForm.css("display", "flex");
        registroForm.css("display", "none");
    }
});  

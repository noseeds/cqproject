/* function consultarBDD(xht){
    console.log("b");
    if(xht.readyState === 4 && (xht.status >= 200 && xht.status < 300)){
        //JSON.parse(this.response);
        console.log("c");
        const resultado = xht.responseText;

        alert(resultado);
        //miPoke.innerHTML = pokemon.id + ' - ' + pokemon.name + '<br> <img src="' + pokemon.sprites.front_default + '">';
    }
}
function consulta(){
    const xht = new XMLHttpRequest();

    xht.addEventListener('load', function() {
        consultarBDD(xht);
    });
    
    xht.open('POST', 'bdd.php');
    xht.send();
    console.log("a");
} */

$("#formulario_registro").on("submit", function(event){
    event.stopPropagation();
    event.preventDefault();
    const formularioData = new FormData(this);
    // Enviar la input del formulario con fetch
    fetch('registrar.php', {
        method: 'POST',
        body: formularioData
    })
    .then(response => response.text()) // Asumiendo que el servidor devuelve una respuesta de texto
    .then(data => {
        // Mostrar la respuesta del servidor
        document.getElementById('respuesta_servidor').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
	//$("#respuesta_servidor").effect( "shake", { direction: "right", times: 2, distance: 10}, 750);
});

$(document).ready(function() {
    var loginForm = $("#login");
    var registroForm = $("#registro");
    var cambiarFormulario = $("#cambiar_a_registro");
    var ingresar = $("#ingresar");

    cambiarFormulario.click(function() {
        if (loginForm.css("display") === "none") {
            loginForm.css("display", "block");
            registroForm.css("display", "none");
            //cambiarFormulario.text("cambiar a registro");
        } else {
            loginForm.css("display", "none");
            registroForm.css("display", "block");
        }
    });

        //registroForm.hide(175, "swing");
    ingresar.click(function() {
        loginForm.hide(175, "swing");
    });

});  

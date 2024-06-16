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

$(document).ready(function() {
    var loginForm = $("#login");
    var registroForm = $("#registro");
    $('.registro_o_acceso').click(function() {
        if (loginForm.css("display") === "none") {
            loginForm.css("display", "flex");
            registroForm.css("display", "none");
        } else {
            loginForm.css("display", "none");
            registroForm.css("display", "flex");
        }
    });
        //registroForm.hide(175, "swing");
    /*ingresar.click(function() {
        loginForm.hide(175, "swing");
    });*/

});  

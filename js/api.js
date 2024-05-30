
//XMLHttp =
// XMLHttp = consulta XMLHttp
// xht = una consulta XMLHttp
function consulta(){
    const xht = new XMLHttpRequest();

    xht.addEventListener('load', consultarBDD);
    xht.open('GET', 'bdd.php');
    xht.send();
}

function consultarBDD(){
    if(this.readyState === 4 && (this.status >= 200 && this.status < 300)){
        //JSON.parse(this.response);
        const resultado = xht.responseText;

        const div1 = document.querySelector('#transacciones');

        alert(resultado);
        //miPoke.innerHTML = pokemon.id + ' - ' + pokemon.name + '<br> <img src="' + pokemon.sprites.front_default + '">';
    }
}

/*

const mysql = require('mysql'); 
const conexion = mysql.createConnection({ host: 'localhost', user: 'usuario'
, password: 'contraseña', database: 'nombre_base_datos' });
conexion.connect((error) => { if (error) throw error; 
console.log('Conexión exitosa a la base de datos'); });

conexion.query('SELECT * FROM usuarios', (error, resultados) => 
    { if (error) throw error; console.log('Registros de la tabla "usuarios":', resultados); });

conexion.query('INSERT INTO usuarios (nombre, correo) VALUES (?, ?)', 
['Juan', 'juan@example.com'], (error) => { if (error) throw error; 
console.log('Registro insertado correctamente'); });

*/
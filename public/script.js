var csrf_token = document.getElementById('token').content; 
function listarRestaurantes(filtro){  
    var resultado = document.getElementById("establecimientos");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    formdata.append('buscar',filtro);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarRestaurantes');
    ajax.onload= function (){
        if(ajax.status == 200){
            let users = JSON.parse(ajax.responseText);
            let str = '';
            users.forEach(element =>{
                str += `<div class="restaurantes" id="restaurante">
                <div class="foto">
                    <img src="storage/uploads/${element.id_restaurante}.png" alt="foto">
                </div>
                <div class="texto">
                    <h1>${element.nombre_restaurante}</h1>
                </div>
                <div class="texto">
                    <p>${element.descripcion_restaurante}</p>
                </div>
                <div class="valoracion">
                    <h3>VALORACIÓN</h3>
                    <div class="estrellas-val">
                        <div class="val" id="file2">
                            <img src="{{ asset('img/estrellas-valorar.png') }}" alt="Logo">
                        </div>
                        <progress id="file" max="5" value="3"></progress>
                    </div>
                </div>
            </div>`;
            });
            resultado.innerHTML = str;
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}
listarRestaurantes('');

/* FILTRO*/
document.getElementById("buscar").addEventListener("keyup", () => {
    const filtro = document.getElementById("buscar").value;
    if (filtro == "") {
        listarRestaurantes('');
    }else{
        listarRestaurantes(filtro);
    }
});
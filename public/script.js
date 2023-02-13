var csrf_token = document.getElementById('token').content; 
function listarRestaurantes(id,filtro){  
    var resultado = document.getElementById("establecimientos");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    formdata.append('value',id);
    formdata.append('buscar',filtro);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarRestaurantes');
    ajax.onload= function (){
        if(ajax.status == 200){
            let users = JSON.parse(ajax.responseText);
            let str = '';
            users.forEach(element =>{
                str += `<div class="restaurantes" name="restaurante">
                <div class="foto">
                    <img style='cursor:pointer' src="storage/uploads/${element.id_restaurante}.png" alt="foto">
                </div>
                <div class="texto">
                    <h1>${element.nombre_restaurante}</h1>
                </div>
                <div class="texto">
                    <p>${element.descripcion_restaurante}</p>
                </div>
                <div class="valoracion">
                    <div class="estrellas-val">
                        <div class="val" id="file2">
                            <img src="img/estrellas-valorar.png" alt="Logo">
                        </div>
                        <progress id="file" max="5" value="${element.media}"></progress>
                    </div>
                </div>
            </div>`;
            });
            
            resultado.innerHTML = str;
            var info=document.getElementsByName('establecimientos');
            for(let i=0;i<info.length;i++){
                info[0].addEventListener('click', verInfo);
            }
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}


function verInfo(evt){
    // console.log('sadas');
    var route=evt.target.src;
    const arr=route.split('/')
    var Imagen=arr[arr.length -1]
    var id=Imagen.split('.')
    console.log(id[0]);
    window.location.href="info/" + id[0];
}

function listarTipoComida(){  
    var resultado = document.getElementById("listarTipoComida");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarTipoComida');
    ajax.onload= function (){
        if(ajax.status == 200){
            let tipo_comida = JSON.parse(ajax.responseText);
            let str = '';
            tipo_comida.forEach(element =>{
                str += `<div>
                        <a style='cursor:pointer;' class='tipoComida' onclick=tipoComida('${element.id_cocina}')><img src="./img/${element.imagen_tipo_comida}"></a>
                        <h4 class="text"style="text-align:center; margin-top:4%">${element.tipo_comida}</h4>
                </div>`;
            });
            resultado.innerHTML = str;
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}
listarTipoComida('');
listarRestaurantes(0,'');

/* FILTRO TIPO DE COMIDA */
function tipoComida(id){
    listarRestaurantes(id,""); 
}

/* FILTRO BUSCAR RESTAURANTES*/
document.getElementById("buscar").addEventListener("keyup", () => {
    const filtro = document.getElementById("buscar").value;
    if (filtro == "") {
        listarRestaurantes(0,'');
    }else{
        listarRestaurantes(0,filtro);
    }
});
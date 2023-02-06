var csrf_token = document.getElementById('token').content; 

function listarRestaurantes(filtro){  
    var resultado = document.getElementById("resultado");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    formdata.append('buscar',filtro);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarRestaurantes');
    ajax.onload= function (){
        if(ajax.status == 200){
            let users = JSON.parse(ajax.responseText);
            // console.log(ajax.responseText);
            let str = '';
            users.forEach(element =>{
                str += `<div class='foto'><img src + ${element.imagen_restaurante}+"></div>
                <td class="th-padding">${element.id} </td>
                <td class="th-padding">${element.nombre_user}</td>
                <td class="th-padding">${element.email_user}</td>
                <td class="th-padding"><button type='button' class='btn btn-danger' onclick=Eliminar('${element.id}')>Eliminar</button></td>
            </tr>`;
            });
            resultado.innerHTML = box;
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
var csrf_token = document.getElementById('token').content; 
function listarUser(filtro){  
    var resultado = document.getElementById("resultado");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    formdata.append('buscar',filtro);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarUser');
    ajax.onload= function (){
        if(ajax.status == 200){
            let restaurantes = JSON.parse(ajax.responseText);
            console.log(ajax.responseText);
            let box = '';
            restaurantes.forEach(element =>{
                box += `<tr>
                <td class="th-padding2"><img class="fto" src="storage/uploads/${element.imagen_user}" alt="Logo"></td>
                <td class="th-padding">${element.nombre_user}</td>
                <td class="th-padding">${element.email_user}</td>
                <td class="th-padding"><button type='button' class='btn btn-outline-primary' onclick=Editar('${element.id_user}')><i class="fa-solid fa-pen-to-square"></i></button></td>
                <td class="th-padding"><button type='button' class='btn btn-outline-danger' onclick=Eliminar('${element.id_user}')><i class="fa-solid fa-trash"></i></button></td>
            </tr>`;
            });
            resultado.innerHTML = box;
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}
listarUser('');
/* FILTRO*/
document.getElementById("buscar").addEventListener("keyup", () => {
    const filtro = document.getElementById("buscar").value;
    if (filtro == "") {
        listarUser('');
    }else{
        listarUser(filtro);
    }
});
function Eliminar(id){
    const formdata = new FormData();
    formdata.append('_token',csrf_token);
    formdata.append('_method','delete');
    formdata.append('id',id);
    const ajax = new XMLHttpRequest();
    ajax.open("post","eliminarUser");
    ajax.onload = function(){
        if(ajax.status === 200){
            let respuesta = JSON.parse(ajax.responseText);
            if(respuesta.Resultado == "OK"){
                listarUser('');
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                alert(respuesta.Resultado);
            }
        }
    };
    ajax.send(formdata);
}

/* REGISTRAR O ACTUALIZAR */
registrar.addEventListener("click", (event) => {
    event.preventDefault();
    var form = document.getElementById('frm');  
    var formdata = new FormData(form);
    formdata.append('_token',csrf_token);
    var ajax = new XMLHttpRequest();
    if (id.value !== '') {
        ajax.open('POST', 'actualizarUser/' + id.value);
    } else {
        ajax.open('POST', 'crearUser');
    }
    ajax.onload=function (){
        if(ajax.status === 200){
            respuesta = JSON.parse(ajax.responseText);
            if (respuesta == "OK") {
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Creado',
                    showConfirmButton: false,
                    timer: 1500
                });
                form.reset();
                listarUser('');
            } else{
                registrar.value = "Registrar";
                id.value = "";
                form.reset();
                listarUser('');
                } 
        } else {
            respuesta.innerText = 'Error';
        }
    }
    ajax.send(formdata);
});
/* EDITAR */
 function Editar(id) {
    var formdata = new FormData();
    formdata.append('_token',csrf_token);
    formdata.append('id_user', id);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'editarUser');
    ajax.onload=function (){
        if(ajax.status==200){
                var json=JSON.parse(ajax.responseText);
                document.getElementById('id').value = json.id_user;
                document.getElementById('nombre_user').value = json.nombre_user;
                document.getElementById('email_user').value = json.email_user;
                document.getElementById('registrar').value = "actualizar"
            }
        }
    ajax.send(formdata);
}
var csrf_token = document.getElementById('token').content; 
function listarRestaurantesAdmin(filtro){  
    var resultado = document.getElementById("resultado");
    var formdata = new FormData(); 
    formdata.append('_token',csrf_token);
    formdata.append('buscar',filtro);
    const ajax = new XMLHttpRequest();
    ajax.open('POST','listarRestaurantesAdmin');
    ajax.onload= function (){
        if(ajax.status == 200){
            let restaurantes = JSON.parse(ajax.responseText);
            console.log(ajax.responseText);
            let box = '';
            restaurantes.forEach(element =>{
                box += `<tr>
                <td class="th-padding"> <img style="width:200px;height:100px;border-radius:10px;" src="storage/uploads/${element.id_restaurante}.png" alt="Logo"></td>
                <td class="th-padding">${element.nombre_restaurante}</td>
                <td class="th-padding">${element.tipo_comida}</td>
                <td class="th-padding">${element.email_restaurante}</td>
                <td class="th-padding">${element.descripcion_restaurante}</td>
                <td class="th-padding"><button type='button' class='btn btn-outline-primary' onclick=Editar('${element.id_restaurante}')><i class="fa-solid fa-pen-to-square"></i></button></td>
                <td class="th-padding"><button type='button' class='btn btn-outline-danger' onclick=Eliminar('${element.id_restaurante}')><i class="fa-solid fa-trash"></i></button></td>
            </tr>`;
            });
            resultado.innerHTML = box;
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}
listarRestaurantesAdmin('');
/* FILTRO*/
document.getElementById("buscar").addEventListener("keyup", () => {
    const filtro = document.getElementById("buscar").value;
    if (filtro == "") {
        listarRestaurantesAdmin('');
    }else{
        listarRestaurantesAdmin(filtro);
    }
});

function Eliminar(id){
    const formdata = new FormData();
    formdata.append('_token',csrf_token);
    formdata.append('_method','delete');
    formdata.append('id',id);
    const ajax = new XMLHttpRequest();
    ajax.open("POST","eliminarRestaurante");
    ajax.onload = function(){
        if(ajax.status === 200){
            let respuesta = JSON.parse(ajax.responseText);
            if(respuesta.Resultado == "OK"){
                listarRestaurantesAdmin('');
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
        ajax.open('POST', 'actualizarRestaurante/' + id.value);
    } else {
        ajax.open('POST', 'crearRestaurante');
    }
    ajax.onload=function (){
        if(ajax.status === 200){
            respuesta = JSON.parse(ajax.responseText);//
            if (respuesta == "OK") {
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Creado',
                    showConfirmButton: false,
                    timer: 1500
                });
                form.reset();
                listarRestaurantesAdmin('');
            } else{
                registrar.value = "Registrar";
                id.value = "";
                form.reset();
                listarRestaurantesAdmin('');
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
    formdata.append('id_restaurante', id);
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'editarRestaurante');
    ajax.onload=function (){
        if(ajax.status==200){
                var json=JSON.parse(ajax.responseText);
                document.getElementById('id').value = json.id_restaurante;
                document.getElementById('nombre_restaurante').value = json.nombre_restaurante;
                document.getElementById('imagen_restaurante').file = json.imagen_restaurante;
                document.getElementById('tipo_comida').value = json.tipo_comida;
                document.getElementById('email_restaurante').value = json.email_restaurante;
                document.getElementById('descripcion_restaurante').value = json.descripcion_restaurante;
                document.getElementById('registrar').value = "actualizar"
            }
        }
    ajax.send(formdata);
}
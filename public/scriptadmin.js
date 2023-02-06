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
                <td class="th-padding">${element.id_restaurante} </td>
                <td class="th-padding">${element.nombre_restaurante}</td>
                
                <td class="th-padding <img src="{{ asset('img/adomicilio.png') }}" alt="Logo"></td>

                <td class="th-padding">${element.tipo_comida}</td>
                <td class="th-padding">${element.email_restaurante}</td>
                <td class="th-padding">${element.descripcion_restaurante}</td>
                <td class="th-padding"><button type='button' class='btn btn-outline-success' onclick=Correo('${element.id_restaurante}')><i class="fa-solid fa-envelope"></i></button></td>
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
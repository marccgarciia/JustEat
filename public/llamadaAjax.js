// const READY_STATE_UNINITIALIZED = 0;
// const READY_STATE_LOADING = 1;
// const READY_STATE_LOADED = 2;
// const READY_STATE_INTERACTIVE = 3;
// const READY_STATE_COMPLETE = 4;

// var peticion_http;

// function cargaContenido2(url, metodo, funcion, creado, valor) {

//     if (!creado) {
//         peticion_http = inicializa_xhr();

//         if (peticion_http) {
//             peticion_http.onreadystatechange = funcion;

//         }

//     }
//     var formdata = new FormData();
//     formdata.append('valor', valor);
//     peticion_http.open(metodo, url, true);
//     peticion_http.send(formdata);
// }

// function inicializa_xhr() {
//     if (window.XMLHttpRequest) {
//         return new XMLHttpRequest();
//     } else if (window.ActiveXObject) {
//         return new ActiveXObject("Microsoft.XMLHTTP");
//     }
// }
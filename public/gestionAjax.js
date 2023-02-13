window.onload = pun_Actual(

    )
    
    
    function pun_Actual() {
        var file2 = document.getElementById("file2");
        file2.addEventListener("mousemove", progress);
        file2.addEventListener("mouseout", mirarmedia);
        file2.addEventListener("click", valoracion);
    
        cargaContenido2("pintar_media", 'GET', mostrarDatos_Ac, false)
    
    }
    
    
    
    function progress(evt) {
        var file = document.getElementById("file2").clientWidth;
        var x = evt.offsetX;
        x = x;
        var value = x * 5 / file;
        document.getElementById("file").value = value;
    }
    
    function valoracion(evt) {
        var file = document.getElementById("file2").clientWidth;
        var x = evt.offsetX;
        x = x;
        var value = x * 5 / file;
        var valor = value.toFixed(1)
        cargaContenido2("insert_punt", 'POST', mostrarDatos_Ac, true, valor)
    }
    
    
    
    
    function mirarmedia() {
        cargaContenido2("pintar_media", 'GET', mostrarDatos_Ac, true)
    }
    
    
    
    
    function mostrarDatos_Ac() {
    
        if (peticion_http.readyState == READY_STATE_COMPLETE) {
            if (peticion_http.status == 200) {
                // console.log(peticion_http.responseText)
                document.getElementById("file").value = peticion_http.responseText
            }
        }
    }
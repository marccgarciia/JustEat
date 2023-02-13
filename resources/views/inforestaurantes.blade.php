
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | Just Eat</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK ICONO -->
    <link rel="icon" href="{{ asset('img/justEatLogoMini.png') }}">
    <link rel="stylesheet" href="{!! asset('../resources/css/app.css') !!}">
</head>

<body class="bodyrestaurantes">
    <div class="contenedor">
        <div class="navbar">
            <div class="logo">
                <a href="{{url('/guia')}}"><img src="{{ asset('img/justEatLogo.png') }}" alt="Logo"></a> 
                <!-- <img src="img/JustEatLogo.png" alt=""> -->
            </div>
        </div>  
        <div class="containerregistrar">
            <div class="fondorestaurante">
                @foreach($consulta as $restaurante)
                <img src="{{asset('storage/uploads/'.$restaurante->id_restaurante.'.png')}}" alt="">
            </div>
            <div class="recuadrorestaurante">
            <img class="imagenrestautrante" src="{{asset('img/2.png')}}" alt="">
                <h1>{{$restaurante->nombre_restaurante}}</h1>
                <p>{{$restaurante->tipo_comida}}</p>
                @endforeach
                <div class="estrella-val">
                    <div class="valo" id="file2">
                        <img src="{{ asset('img/estrellas-valorar.png') }}" alt="">
                    </div>
                   
                <progress id="file" max="5"></progress>
       
                
            </div>
            
            </div>
            
            <div class="textorestaurante">
                <div class="c100">
                    <div class="c70">
                        <h1>Nombre usuario </h1>
                        <p>Comentario del usuario </p>
                    </div>
                    <div class="c30">
                        <img src="{{ asset('img/estrellas-valorar.png') }}" alt="">
                    </div>
                </div>
            </div>
            <br>
            </div>
            
            </div>
            
            <br>
            

        </div>
    </div>
<script src="{{asset('llamadaAjax.js')}}"></script>
<script src="{{asset('gestionAjax.js')}}"></script>
</body>
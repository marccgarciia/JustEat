<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | Just Eat</title>
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK ICONO -->
    <link rel="icon" href="{{ asset('img/justEatLogoMini.png') }}">
    <link rel="stylesheet" href="{!! asset('../resources/css/app.css') !!}">
    <!-- TOKEN -->
    <meta name="delete" content="{{ csrf_token() }}" id="token">
</head>
<body class="bodyrestaurantes">
    <div class="contenedor">
        <div class="navbar">
            <div class="logo">
                <a href="{{url('/guia')}}"><img src="{{ asset('img/justEatLogo.png') }}" alt="Logo"></a> 
            </div>
        </div>  
        <div class="containerregistrar">
            <div class="fondorestaurante">
                @foreach($consulta as $restaurante)
                    <img src="{{asset('storage/uploads/'.$restaurante->id_restaurante.'.png')}}" alt="">
                @endforeach
            </div>
            <div class="recuadrorestaurante">
                @foreach($consulta1 as $tipocomida)
                    <img  class="imagenrestautrante" src="{{asset('img/'.$tipocomida->id_cocina.'.png')}}" alt="">
                @endforeach
                @foreach($consulta as $restaurante)
                    <h1>{{$restaurante->nombre_restaurante}}</h1>
                @endforeach
                @foreach($consulta1 as $tipocomida)
                    <p>{{$tipocomida->tipo_comida}}</p>
                @endforeach
                <form action="{{url('/valoraciones')}}" method="post">
                    @csrf
                        <div class="estrella-val">
                            <div class="valo" id="file2">
                                <img src="{{ asset('img/estrellas-valorar.png') }}" alt="">
                            </div> 
                        <progress id="file" max="5"></progress>
                        </div>
                    <textarea class ="textareaa"name="comentario" id="comentario" cols="40" rows="3"></textarea>
                    <br>
                    <input class="boton" type="submit">
                </form>
            </div>
            @foreach($consulta2 as $comentario)
                <div class="textorestaurante">
                    <div class="c100">
                        <div class="c70">
                        <h1>Usuario Anonimo</h1>
                            <p>{{$comentario->comentario}} </p>
                        </div>
                        <div class="c30">
                            <img class="fotooo" src="{{ asset('img/estrellas-valorar.png') }}" alt="">
                            <progress class="progres" id="file" max="5" value="{{$comentario->nota}}"></progress>
                        </div>
                    </div>
                </div>
            @endforeach
            <br>
            </div>
            </div>
            <br>
        </div>
    </div>
<script src="{{asset('gestionAjax.js')}}"></script>
</body>
</html>
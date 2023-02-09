<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida a domicilio y para llevar | Just Eat</title>
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK ICONO -->
    <link rel="icon" href="{{ asset('img/justEatLogoMini.png') }}">
    <!-- BOOSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="{!! asset('../resources/css/app.css') !!}">
    <!-- TOKEN -->
    <meta name="delete" content="{{ csrf_token() }}" id="token">

</head>
<body>
   <div class="grande">
        <div class="cajon">
            <div class="mediano">
                <img src="{{ asset('img/JustEatLogo.png') }}" alt="Logo">
            </div>
            <div class="pequeño">
                <H1>¿Quieres comida a domicilio?</H1>
                <p>¡Regístrate/Inicia sesión y pide tu lugar favorito!</p>
            </div>
            <a href="{{url('register')}}"><button type="submit" class="regist">REGISTRAR</button></a>
            <a href="{{url('login')}}"><button type="submit" class="regist">ENTRAR</button></a>
        </div>
   </div>
</body>
</html>
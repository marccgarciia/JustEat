<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta | Just Eat</title>
    <link rel="stylesheet" href="styles.css">
    <!-- LINK FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2b5286e1aa.js" crossorigin="anonymous"></script>
    <!-- LINK ICONO -->
    <link rel="icon" href="{{ asset('img/justEatLogoMini.png') }}">
    <link rel="stylesheet" href="{!! asset('../resources/css/app.css') !!}">
</head>

<body>
    <div class="contenedor">
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('img/justEatLogo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="containerregistrar flex">
            <div class="cajaregistrar flex">
            <img src="{{ asset('img/adomicilio.png') }}" alt="Logo">
                <h6><b>Crear cuenta</b></h6>
                <a href="">¿Ya formas parte de Just Eat?</a>
                <form  action="{{url('registerpost')}}" method="POST">
                    @csrf  
                    <label for="nombre"><b>Nombre</b></label>
                    <input type="text" id="nombre_user" name="nombre_user">
                    <label for="correo"><b>Correo electrónico</b></label>
                    <input type="text" id="email_user" name="email_user">
                    <label for="contrasena"><b>Contraseña</b></label>
                    <input type="password" id="password_user" name="password_user">
                    <button class="custom-btn btn-1">Crear cuenta</button>
            </div>
        </div>
    </div>
</body>
</html>
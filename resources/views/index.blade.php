<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida a domicilio y para llevar | Just Eat</title>
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
        <div class="contenido">
            <div class="login">
            <h2>Inicia Sesión</h2>
            <h3>Comida a domicilio online cerca de ti</h3>
                <form action="{{url('loginpost')}}" method="POST">
                    @csrf
                    <input type="text" id="email" name="email_user" placeholder="Usuario">
                    <input type="text" id="password" name="password_user" placeholder="Contraseña">
                    <button type="submit" name="entrar" id="entrar">ENTRAR</button>
                </form>
                <p class="registro">¿Aún no estás registrado? Regístrate <a href="{{url('/register')}}">AQUÍ</a></p>
            </div>
        </div>
        <div class="caja">
            <div class="imagenCentrada">
                <img src="{{ asset('img/selular.png') }}" alt="selular">
            </div>
            <div class="textoCentrado">
                <h1>Pide comida a domicilio aún más rápido</h1>
                <p>Descárgate gratis la app de Just Eat y pide tu comida a domicilio estés donde estés.</p>
                <img style="width: 25%;"src="{{ asset('img/AppStore.png') }}" alt="selular">
                <img style="width: 25%;" src="{{ asset('img/GooglePlay.png') }}" alt="selular">
            </div>
        </div>
    </div>
 <!-- FOOTER -->
    <footer class="footer">
        <div class="footer__center">
            <div class="footer__fila">
                <ul class="footer__ul">
                    <li class="footer__li"><a href="https://www.just-eat.es/help" class="footer__a">Ayuda</a></li>
                    <li class="footer__li"><a href="#" class="footer__a">Iniciar sesión</a></li>
                    <li class="footer__li"><a href="" class="footer__a">Regístrate</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/info/garantia-de-precio" class="footer__a">Garantía de precio</a></li>
                </ul>
                <ul class="footer__ul">
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi/comida-china" class="footer__a">Comida china</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi/kebab" class="footer__a">Kebab</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi/pizza" class="footer__a">Pizza</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi/sushi" class="footer__a">Sushi</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi/comida-mexicana" class="footer__a">Comida mexicana</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cerca-de-mi" class="footer__a">Más tipos de cocina</a></li>
                </ul>
                <ul class="footer__ul">
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas/burger-king" class="footer__a">Burger King</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas/mcdonalds" class="footer__a">McDonald's</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas/telepizza" class="footer__a">Telepizza</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas/papa-johns" class="footer__a">Papa John's</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas/taco-bell" class="footer__a">Taco Bell</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/a-domicilio/cadenas" class="footer__a">Más cadenas</a></li>
                </ul>
                <ul class="footer__ul">
                    <li class="footer__li"><a href="https://www.justeattakeaway.com/" class="footer__a">Quienes somos</a></li>
                    <li class="footer__li"><a href="https://careers.justeattakeaway.com/global/en" class="footer__a">Trabaja con nosotros</a></li>
                    <li class="footer__li"><a href="https://restaurantes.just-eat.es/" class="footer__a">Regístra tu restaurante</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/info/terminos-y-condiciones" class="footer__a">Términos y Condiciones</a></li>
                    <li class="footer__li"><a href="https://www.just-eat.es/info/legal-information" class="footer__a">Información legal</a></li>

                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
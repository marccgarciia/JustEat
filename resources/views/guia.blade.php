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
    <!-- SWA -->
    
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('img/justEatLogo.png') }}" alt="Logo">
        </div>
        <div class="usuario">
            <a href="perfil"><i class="fa-solid fa-circle-user"></i></a>
            <a href="{{url('/logoutpost')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
    </div>
    <?php
    $email = session()->get('email_user');
    $admin = session()->get('is_admin');
    if ($admin == 1) {
    ?>
        <!--PARTE ADMINISTRADR -->
        <div class="formularioCrear">
            <!-- FOTO -->
            <img class="imgRestaurante" src="{{ asset('img/logo_res.png') }}" alt="">
            <!-- FORMULARIO -->
            <form action="" class="formAdminCrear" method="POST" id="frm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group-container">
                    <div class="form-group">
                        <input type="text" name="nombre_restaurante" id="nombre_restaurante" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tipo_comida" id="tipo_comida" placeholder="Tipo">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email_restaurante" id="email_restaurante" placeholder="Correo">
                    </div>
                    <div class="form-group">
                        <input type="text" name="descripcion_restaurante" id="descripcion_restaurante" placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        <input type="file" name="imagen_restaurante" id="imagen_restaurante">
                    </div>
                    <div class="form-group">
                        <input class="header__login" id="registrar" type="submit">Crear</input>
                    </div>
                </div>
            </form>
        </div>
        <div class="filtro">
            <form class="formAdmin" action="" method="post" id="frmbusqueda">
                <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
            </form>
        </div>
        <div class="main-container">
            <table class="div-table " style="margin-bottom: 5%;">
                <thead>
                    <tr>
                    <!-- <th class="th-padding">Id</th> -->
                    <th class="th-padding">Imagen </th>
                    <th class="th-padding">Nombre</th>
                    
                    <th class="th-padding">Tipo Comida</th>
                    <th class="th-padding">Email</th>
                    <th class="th-padding">Descripción</th>
                    <th class="th-padding">Editar</th>
                    <th class="th-padding">Eliminar</th>
                    </tr>
                </thead>
                <tbody id='resultado'>
                    <!-- CONTENIDO TABLA -->
                </tbody>
            </table>
        </div>
    <?php
    } else {
    ?>
        <!-- PARTE USUARIO -->
        <div class="buscar">
            <input type="text" name="buscar" id="buscar" placeholder="Buscar...">
            <label for="valoracion">Valoración:</label>
            <select name="valoracion" id="valoracion">
                <option value="1">1 Estrella</option>
                <option value="2">2 Estrellas</option>
                <option value="3">3 Estrellas</option>
                <option value="4">4 Estrellas</option>
                <option value="5" selected>5 Estrellas</option>
            </select>
        </div>
        <!-- RESTAURANTE -->
        <div class="establecimientos">
            <div class="restaurantes" id="restaurante">
                <div class="foto">
                    <img src="foto.jpg" alt="foto">
                </div>
                <div class="texto">
                    <h1>Telepizza</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit dictum metus, mus nibh cubilia hac est laoreet gravida quam lobortis molestie, leo fringilla vivamus pharetra eleifend primis ac nisi.</p>
                </div>
                <div class="valoracion">
                    <h3>VALORACIÓN</h3>
                    <p>5 Estrellas</p>
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
    <?php
    }
    ?>
    <script src="{{asset('scriptadmin.js')}}"></script>

</body>

</html>
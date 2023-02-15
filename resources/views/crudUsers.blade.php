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
    <?php
    $email = session()->get('email_user');
    $admin = session()->get('is_admin');
    if ($admin == 1) {
    ?>
    <!--PARTE ADMINISTRADR -->
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('img/justEatLogo.png') }}" alt="Logo">
            </div>
            <div class="usuario1">
                <a href="{{url('/guia')}}"><i class="fa-sharp fa-solid fa-utensils"></i></a>
            </div>
            <div class="usuario">
                <a href="{{url('/logoutpost')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="formularioCrear">
            <!-- FOTO -->
            <img class="imgRestaurante" src="{{ asset('img/sinfoto.jpg') }}" alt="">
            <!-- FORMULARIO -->
            <form action="" class="formAdminCrear" method="POST" id="frm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group-container">
                    <div class="form-group">
                        <input type="text" name="nombre_user" id="nombre_user" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email_user" id="email_user" placeholder="Correo">
                    </div>
                        
                    <div class="form-group">
                        <input type="file" name="imagen_user" id="imagen_user">
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
                    <th class="th-padding">ID</th>
                    <th class="th-padding">Nombre</th>
                    <th class="th-padding">Email</th>
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
}else{

}
?>
<script src="{{asset('scriptUser.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
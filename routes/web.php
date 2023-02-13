<?php

use App\Http\Controllers\RestauranteController;
use App\Models\Restaurante;
use Illuminate\Support\Facades\Route;

//INDEX
Route::get('/', [RestauranteController::class, 'index']);
//login
Route::get('/login', [RestauranteController::class, 'login']);
//REGISTER
Route::get('/register', [RestauranteController::class, 'register']);
//GUIA DE RESTAURANTES
Route::get('/guia', [RestauranteController::class, 'guia']);


/* USERS */
Route::get('/crudUsers', [RestauranteController::class, 'crudUsers']);
//LISTAR USERS
Route::post('/listarUser', [RestauranteController::class, 'listarUser']);
//CREAR USERS
Route::post('/crearUser', [RestauranteController::class, 'crearUser']);
//ELIMINAR USERS
Route::delete('/eliminarUser', [RestauranteController::class, 'eliminarUser']);
//EDITAR USER
Route::post('/editarUser',[RestauranteController::class, 'editarUser']);
//ACTUALIZAR USER
Route::post('/actualizarUser/{id}',[RestauranteController::class, 'actualizarUser']);

/* RESTAURANTES */
Route::post('/listarRestaurantesAdmin',[RestauranteController::class, 'listarRestaurantesAdmin']);
Route::post('/listarRestaurantes',[RestauranteController::class, 'listarRestaurantes']);
Route::delete('/eliminarRestaurante',[RestauranteController::class, 'eliminarRestaurante']);
Route::post('/listarTipoComida',[RestauranteController::class, 'listarTipoComida']);
Route::post('/crearRestaurante',[RestauranteController::class, 'crearRestaurante']);
Route::post('/editarRestaurante',[RestauranteController::class, 'editarRestaurante']);
Route::post('/actualizarRestaurante/{id}',[RestauranteController::class, 'actualizarRestaurante']);

//RUTAS SINGIN LOGIN 
Route::post('/loginpost',[RestauranteController::class, 'loginpost']);
Route::post('/registerpost',[RestauranteController::class, 'registerpost']);
Route::get('/logoutpost',[RestauranteController::class, 'logoutpost']);

//RUTA INFO RESTAURANTE
Route::get('/info/{id}',[RestauranteController::class, 'infoRestaurante']);


// INSERT VALORACIONES
// Route::get('/pintar_media',[RestauranteController::class, 'pintar_media']);
// Route::post('/insert_punt',[RestauranteController::class, 'insert_punt']);
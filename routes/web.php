<?php

use App\Http\Controllers\RestauranteController;
use App\Models\Restaurante;
use Illuminate\Support\Facades\Route;

//INDEX
Route::get('/', [RestauranteController::class, 'index']);
//LOGIN
Route::get('/login', [RestauranteController::class, 'login']);
//REGISTER
Route::get('/register', [RestauranteController::class, 'register']);
//GUIA DE RESTAURANTES
Route::get('/guia', [RestauranteController::class, 'guia']);

//RESTAURANTES
Route::post('/listarRestaurantesAdmin',[RestauranteController::class, 'listarRestaurantesAdmin']);
Route::delete('/eliminarRestaurante',[RestauranteController::class, 'eliminarRestaurante']);

//RUTAS SINGIN LOGIN 
Route::post('/loginpost',[RestauranteController::class, 'loginpost']);
Route::post('/registerpost',[RestauranteController::class, 'registerpost']);
Route::get('/logoutpost',[RestauranteController::class, 'logoutpost']);

Route::post('/crearRestaurante',[RestauranteController::class, 'crearRestaurante']);
Route::post('/editarRestaurante',[RestauranteController::class, 'editarRestaurante']);
Route::post('/actualizarRestaurante/{id}',[RestauranteController::class, 'actualizarRestaurante']);
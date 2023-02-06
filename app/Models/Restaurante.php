<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model{
    /* use HasFactory; */
    protected $table = 'restaurantes';
    protected $fillable = [
        'nombre_restaurante', 'imagen_restaurante', 'tipo_comida', 'email_restaurante', 'descripcion_restaurante'
    ];
    protected $primaryKey = 'id_restaurante';
   /*  public $timestamps = false;  */
}


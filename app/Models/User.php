<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model{
    use HasFactory;
    
    protected $fillable = ['nombre_user', 'email_user', 'password_user', 'is_admin', 'imagen_user'];
    protected $primaryKey = 'id_user';
    public $timestamps = false; 
}

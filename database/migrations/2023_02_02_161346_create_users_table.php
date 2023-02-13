<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('nombre_user', 50);
            $table->string('email_user', 50);
            $table->string('imagen_user', 250)->default('0.png');
            $table->string('password_user', 50);
            $table->tinyInteger('is_admin')->default(0);
            $table->timestamps();
        });      
    }
    public function down(){
        Schema::dropIfExists('users');
    }
}

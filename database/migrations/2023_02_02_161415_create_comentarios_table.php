<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionesTable extends Migration{
    public function up(){
        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id_comentario');
            $table->string('comentario', 255);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_restaurante');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade'); 
        });
    }
    public function down(){
        Schema::dropIfExists('comentarios');
    }
}
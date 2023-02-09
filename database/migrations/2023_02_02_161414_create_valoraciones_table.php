<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionesTable extends Migration{

    public function up(){
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->increments('id_valoracion');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_restaurante');
            $table->float('nota');
        
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade'); 
        });  
    }
    public function down(){
        Schema::dropIfExists('valoraciones');
    }
}

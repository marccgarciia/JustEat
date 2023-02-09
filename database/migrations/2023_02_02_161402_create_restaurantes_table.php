<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantesTable extends Migration{

    public function up(){
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->increments('id_restaurante');
            $table->string('nombre_restaurante', 20);
            $table->string('imagen_restaurante', 255);
            $table->integer('tipo_comida');
            $table->decimal('media', 10, 1);
            $table->string('email_restaurante', 50);
            $table->string('descripcion_restaurante', 150);
            $table->timestamps();
        });        
    }

    public function down(){
        Schema::dropIfExists('restaurantes');
    }
}

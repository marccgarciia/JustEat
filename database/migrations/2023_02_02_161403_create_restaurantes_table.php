<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantesTable extends Migration{

    public function up(){
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->bigIncrements('id_restaurante');
            $table->string('nombre_restaurante', 50);
            $table->string('imagen_restaurante', 255)->default('0.png');
            $table->unsignedBigInteger('tipo_comida');
            $table->decimal('media', 10, 1)->default(0);
            $table->string('email_restaurante', 50);
            $table->string('descripcion_restaurante', 150);
            $table->timestamps();
            $table->foreign('tipo_comida')->references('id_cocina')->on('cocinas')->onDelete('cascade');
        });
            
    }

    public function down(){
        Schema::dropIfExists('restaurantes');
    }
}

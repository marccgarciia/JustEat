<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocinasTable extends Migration{

    public function up(){
        Schema::create('cocinas', function (Blueprint $table) {
            $table->bigIncrements('id_cocina');
            $table->string('tipo_comida');
            $table->string('imagen_tipo_comida', 255);
        });
    }
    public function down(){
        Schema::dropIfExists('cocinas');
    }
}

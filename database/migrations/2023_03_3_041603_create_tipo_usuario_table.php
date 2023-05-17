<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoUsuarioTable extends Migration
{
   
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nulable(false);
            $table->string('status')->default('Y');

            $table->timestamps();
        });
    }

       public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
}

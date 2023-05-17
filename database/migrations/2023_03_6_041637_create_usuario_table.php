<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nulable(false);
            $table->string('password')->nulable(false);
            $table->unsignedBigInteger('tipo_usuario_id');
            $table->foreign('tipo_usuario_id')
                  ->references('id')
                  ->on('tipo_usuarios')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');
                    $table->string('status')->default('Y');

            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

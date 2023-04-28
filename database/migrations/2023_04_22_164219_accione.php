<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Accione extends Migration
{
    public function up()
    {
        Schema::create('acciones', function (Blueprint $table) {
            $table->id();
            $table->string('fecha')->nulable(false);
            $table->text('descripcion')->nulable(false);
            $table->string('modo')->nulable(false);

            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')
                    ->references('id')
                    ->on('usuarios')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');
            $table->string('status')->default('Y');
            $table->timestamps();
        });   
     }

    public function down()
    {
        Schema::dropIfExists('acciones');
    }
}

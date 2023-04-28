<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comentario extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nulable(false);
            $table->string('fecha')->nulable(false);

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

            $table->string('status')->default('Y');
            $table->timestamps();
        });   
     }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}

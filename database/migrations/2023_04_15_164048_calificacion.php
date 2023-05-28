<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calificacion extends Migration
{
    public function up()
    {
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();

            $table->dateTimeTz('fecha')->nulable(false);
            $table->text('descripcion')->nulable(false);
            $table->string('puntaje')->nulable(false);
            $table->string('ticketCodigo')->nulable(false);
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets')
                  ->onDelete('cascade');
            $table->string('status')->default('Y');
            $table->timestamps();
        });   
     }

    public function down()
    {
        Schema::dropIfExists('calificacions');
    }
}

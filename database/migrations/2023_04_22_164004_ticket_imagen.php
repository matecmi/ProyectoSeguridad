<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketImagen extends Migration
{
    public function up()
    {
        Schema::create('ticket_imagens', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->nulable(false);
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets')
                  ->onDelete('cascade');
            $table->string('status')->default('Y');
            $table->timestamps();
        });    }

    public function down()
    {
        Schema::dropIfExists('ticket_imagens');
    }
    
}

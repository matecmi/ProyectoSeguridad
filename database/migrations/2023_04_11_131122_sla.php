<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sla extends Migration
{
  
    public function up()
    {
        Schema::create('slas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nulable(false);
            $table->integer('horas')->nulable(false);
            $table->integer('tiempo_primera_respuesta')->nulable(false);
            $table->string('status')->default('Y');
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('slas');
    }
}

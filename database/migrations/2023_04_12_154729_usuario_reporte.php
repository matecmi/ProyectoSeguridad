<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuarioReporte extends Migration
{
    public function up()
    {
        Schema::create('usuario_reportes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('status')->default('Y');
            $table->timestamps();
        });    
    }

    public function down()
    {
        Schema::dropIfExists('usuario_reportes');
    }
    
}

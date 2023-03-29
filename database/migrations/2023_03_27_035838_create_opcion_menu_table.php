<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion_menus', function (Blueprint $table) {
            $table-> id();
            $table->string('nombre')->nulable(false);
            $table->string('ruta')->nulable(false);
            $table->string('orden')->nulable(false);
            $table->string('icono')->nulable(false);
            $table->unsignedBigInteger('grupo_menus_id');
            $table->foreign('grupo_menus_id')
                  ->references('id')
                  ->on('grupo_menus')
                  ->onDelete('cascade');
            $table->string('status')->default('Y');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opcion_menus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opcion_menu_id');
            $table->foreign('opcion_menu_id')
                  ->references('id')
                  ->on('opcion_menus')
                  ->onDelete('cascade');
                  $table->unsignedBigInteger('tipo_usuario_id');
                  $table->foreign('tipo_usuario_id')
                        ->references('id')
                        ->on('tipo_usuarios')
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
        Schema::dropIfExists('accesos');
    }
}

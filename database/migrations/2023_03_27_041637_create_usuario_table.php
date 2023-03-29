<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nulable(false);
            $table->string('password')->nulable(false);
            $table->unsignedBigInteger('tipo_usuario_id');
            $table->foreign('tipo_usuario_id')
                  ->references('id')
                  ->on('tipo_usuario')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')
                    ->references('id')
                    ->on('persona')
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
        Schema::dropIfExists('usuario');
    }
}

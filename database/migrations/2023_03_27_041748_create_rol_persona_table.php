<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_persona', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')
                    ->references('id')
                    ->on('rol')
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
        Schema::dropIfExists('rol_persona');
    }
}

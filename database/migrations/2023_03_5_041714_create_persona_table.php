<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nulable(false);
            $table->string('apellidopaterno')->nulable(false);
            $table->string('apellidomaterno')->nulable(false);
            $table->string('dni')->nulable(false);
            $table->string('ruc')->nulable(false);
            $table->string('telefno')->nulable(false);
            $table->string('email')->nulable(false);
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
        Schema::dropIfExists('personas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ticket extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->string('fecha_registro')->nulable(false);
            $table->string('fecha_inicio')->nulable(true);
            $table->string('fecha_fin_estimado')->nulable(true);
            $table->string('fecha_fin')->nulable(true);
            $table->string('descripcion')->nulable(false);
            $table->string('situacion')->nulable(false);

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('tipoincidencia_id');
            $table->foreign('tipoincidencia_id')
                   ->references('id')
                   ->on('tipo_incidencias')
                   ->onDelete('cascade');

            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('supervisor_id');
            $table->foreign('supervisor_id')
                    ->references('id')
                    ->on('personas')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('sla_id');
            $table->foreign('sla_id')
                   ->references('id')
                   ->on('slas')
                   ->onDelete('cascade');
            $table->string('status')->default('Y');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

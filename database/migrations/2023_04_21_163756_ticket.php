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

            $table->dateTimeTz('fecha_registro')->nulable(false);
            $table->dateTimeTz('fecha_fin_estimado')->nulable(true);
            $table->dateTimeTz('fecha_primera_respuesta')->nullable();
            $table->dateTimeTz('fecha_fin')->nullable();
            $table->text('descripcion')->nulable(false);
            $table->string('situacion')->nulable(false);
            $table->string('usuario_reporte_nombre')->nullable();
            $table->string('usuario_reporte_email')->nullable();
            $table->string('usuario_reporte_telefono')->nullable();

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

            $table->unsignedBigInteger('medio_reporte_id');
            $table->foreign('medio_reporte_id')
                   ->references('id')
                   ->on('medio_reportes')
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

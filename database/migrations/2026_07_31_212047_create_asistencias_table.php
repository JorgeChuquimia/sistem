<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');

            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('materia_id');

            $table->foreign('docente_id')->references('id_docente')->on('docentes')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            $table->foreign('materia_id')->references('id_materia')->on('materias')->onDelete('cascade');

            $table->string('fecha', 50);
            $table->string('observacion', 255)->nullable();

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};

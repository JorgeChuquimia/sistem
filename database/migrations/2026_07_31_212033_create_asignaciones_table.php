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
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('id_asignacion');

            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('nivel_id');
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('materia_id');

            $table->foreign('docente_id')->references('id_docente')->on('docentes')->onDelete('cascade');
            $table->foreign('nivel_id')->references('id_nivel')->on('niveles')->onDelete('cascade');
            $table->foreign('grado_id')->references('id_grado')->on('grados')->onDelete('cascade');
            $table->foreign('materia_id')->references('id_materia')->on('materias')->onDelete('cascade');

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};

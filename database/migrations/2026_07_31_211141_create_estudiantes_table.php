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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('id_estudiante');

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade');

            // Nota: Las tablas 'niveles' y 'grados' las crearemos en un momento, 
            // por ahora puedes dejar estas columnas preparadas:
            $table->unsignedBigInteger('nivel_id');
            $table->unsignedBigInteger('grado_id');

            $table->string('rude', 50);

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};

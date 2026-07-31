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
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona'); // Llave primaria personalizada

            // Llave foránea hacia la tabla usuarios
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');

            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('ci', 20);
            $table->string('fecha_nacimiento', 20);
            $table->string('profesion', 50);
            $table->string('direccion', 255);
            $table->string('celular', 20);

            $table->boolean('estado')->default(true);
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};

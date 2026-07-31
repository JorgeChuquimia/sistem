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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); // Llave primaria personalizada

            // Llave foránea hacia la tabla roles
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id_rol')->on('roles')->onDelete('cascade');

            $table->string('email')->unique();
            $table->text('password');
            $table->boolean('estado')->default(true);
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

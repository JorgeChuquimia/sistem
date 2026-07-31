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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id('id_docente');

            // Llave foránea hacia personas
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id_persona')->on('personas')->onDelete('cascade');

            $table->string('especialidad');
            $table->string('antiguedad');
            $table->string('rda', 20);

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};

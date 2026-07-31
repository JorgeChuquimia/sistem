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
        Schema::create('niveles', function (Blueprint $table) {
            $table->id('id_nivel');

            $table->unsignedBigInteger('gestion_id');
            $table->foreign('gestion_id')->references('id_gestion')->on('gestiones')->onDelete('cascade');

            $table->string('nivel');
            $table->string('turno');

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveles');
    }
};

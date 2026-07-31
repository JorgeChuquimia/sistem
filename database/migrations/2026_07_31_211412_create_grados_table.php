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
        Schema::create('grados', function (Blueprint $table) {
            $table->id('id_grado');

            $table->unsignedBigInteger('nivel_id');
            $table->foreign('nivel_id')->references('id_nivel')->on('niveles')->onDelete('cascade');

            $table->string('curso');
            $table->string('paralelo');

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grados');
    }
};

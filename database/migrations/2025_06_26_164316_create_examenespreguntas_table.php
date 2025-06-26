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
        Schema::create('examenespreguntas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_exam');
            $table->unsignedBigInteger('id_pregunta');
            $table->boolean('activo')->default(true);
            $table->foreign('id_exam')->references('id')->on('examenes');
            $table->foreign('id_pregunta')->references('id')->on('preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examenespreguntas');
    }
};

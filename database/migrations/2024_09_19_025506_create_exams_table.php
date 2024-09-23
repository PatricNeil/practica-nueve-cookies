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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del examen
            $table->text('description')->nullable(); // Descripción del examen
            $table->timestamp('start_time'); // Hora de inicio del examen
            $table->timestamp('end_time'); // Hora de fin del examen
            $table->integer('duration')->comment('Duración del examen en minutos'); // Duración en minutos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

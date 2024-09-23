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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // Relación con el examen
            $table->text('question_text'); // Texto de la pregunta
            $table->string('option_a'); // Opción A
            $table->string('option_b'); // Opción B
            $table->string('option_c'); // Opción C
            $table->string('option_d'); // Opción D
            $table->string('correct_answer'); // Respuesta correcta (A, B, C o D)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

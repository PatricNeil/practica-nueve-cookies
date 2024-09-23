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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // Relación con el examen
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Relación con la pregunta
            $table->string('selected_option'); // Respuesta seleccionada por el usuario
            $table->integer('attempt')->default(1); // Agregar el campo de intento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};

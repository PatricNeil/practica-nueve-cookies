<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;

class QuestionController extends Controller
{
    // Mostrar la lista de preguntas de un examen específico
    public function index(Exam $exam)
    {
        $questions = $exam->questions;
        return view('questions.index', compact('exam', 'questions'));
    }

    // Mostrar el formulario para crear una nueva pregunta
    public function create(Exam $exam)
    {
        return view('questions.create', compact('exam'));
    }

    // Guardar una nueva pregunta
    public function store(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $exam->questions()->create($validatedData);
        return redirect()->route('questions.index', $exam)->with('success', 'Pregunta creada con éxito.');
    }

    // Mostrar el formulario para editar una pregunta existente
    public function edit(Exam $exam, Question $question)
    {
        return view('questions.edit', compact('exam', 'question'));
    }

    // Actualizar una pregunta existente
    public function update(Request $request, Exam $exam, Question $question)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $question->update($validatedData);
        return redirect()->route('questions.index', $exam)->with('success', 'Pregunta actualizada con éxito.');
    }

    // Eliminar una pregunta
    public function destroy(Exam $exam, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index', $exam)->with('success', 'Pregunta eliminada con éxito.');
    }
}

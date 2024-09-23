<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam; // Add this line to import the Exam model
use Illuminate\Support\Facades\Auth; // Add this line to import the Auth facade
use App\Models\UserAnswer; // Add this line to import the UserAnswer model

class ExamSolveController extends Controller
{
    // Mostrar todos los exámenes disponibles para resolver
    public function index()
    {
        $exams = Exam::all();
        return view('exams.solve.index', compact('exams'));
    }

    // Mostrar las preguntas de un examen específico
    public function show(Exam $exam)
    {
        $questions = $exam->questions;
        return view('exams.solve.show', compact('exam', 'questions'));
    }

    // Procesar y guardar las respuestas enviadas por el usuario
    public function submit(Request $request, Exam $exam)
    {
        // Validar que el usuario ha respondido todas las preguntas
        $validatedData = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string|in:A,B,C,D',
        ]);

        $user = Auth::user();

        // Obtener el número de intento más alto del usuario en este examen
        $lastAttempt = UserAnswer::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->max('attempt');

        $newAttempt = $lastAttempt ? $lastAttempt + 1 : 1; // Si no hay intentos, el primer intento será 1

        // Guardar cada respuesta en la base de datos con el número de intento
        foreach ($validatedData['answers'] as $questionId => $selectedOption) {
            UserAnswer::create([
                'user_id' => $user->id,
                'exam_id' => $exam->id,
                'question_id' => $questionId,
                'selected_option' => $selectedOption,
                'attempt' => $newAttempt, // Guardar el nuevo número de intento
            ]);
        }

        // Redirigir al usuario a la página de resultados
        return redirect()->route('exams.solve.result', $exam)->with('success', 'Examen completado con éxito.');
    }


    // Mostrar los resultados del examen
    public function result(Exam $exam)
    {
        $user = Auth::user();

        // Obtener las respuestas del usuario para este examen
        $userAnswers = UserAnswer::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->get();

        $correctAnswers = 0;

        // Comparar las respuestas del usuario con las respuestas correctas
        foreach ($userAnswers as $userAnswer) {
            if ($userAnswer->question->correct_answer === $userAnswer->selected_option) {
                $correctAnswers++;
            }
        }

        // Calcular el puntaje (por ejemplo, porcentaje de respuestas correctas)
        $totalQuestions = $exam->questions->count();
        $score = ($correctAnswers / $totalQuestions) * 100;

        return view('exams.solve.result', compact('exam', 'score', 'correctAnswers', 'totalQuestions'));
    }
}

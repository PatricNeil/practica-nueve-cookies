<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamSolveController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('exams', ExamController::class);

// Rutas para preguntas dentro de un examen específico
Route::prefix('exams/{exam}')->group(function () {
    Route::resource('questions', QuestionController::class);
});
Route::prefix('solve')->group(function () {
    // Ruta para mostrar la lista de exámenes disponibles para resolver
    Route::get('/', [ExamSolveController::class, 'index'])->name('exams.solve.index');

    // Ruta para mostrar las preguntas de un examen
    Route::get('/{exam}', [ExamSolveController::class, 'show'])->name('exams.solve.show');

    // Ruta para enviar las respuestas del examen
    Route::post('/{exam}', [ExamSolveController::class, 'submit'])->name('exams.solve.submit');

    // Ruta para mostrar el resultado del examen
    Route::get('/{exam}/result', [ExamSolveController::class, 'result'])->name('exams.solve.result');
});
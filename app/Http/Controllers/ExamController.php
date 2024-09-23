<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    // Mostrar la lista de exámenes
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    // Mostrar el formulario para crear un nuevo examen
    public function create()
    {
        return view('exams.create');
    }

    // Guardar un nuevo examen
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
        ]);

        Exam::create($validatedData);
        return redirect()->route('exams.index')->with('success', 'Examen creado con éxito.');
    }

    // Mostrar el formulario para editar un examen existente
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    // Actualizar un examen existente
    public function update(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
        ]);

        $exam->update($validatedData);
        return redirect()->route('exams.index')->with('success', 'Examen actualizado con éxito.');
    }

    // Eliminar un examen
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Examen eliminado con éxito.');
    }
}

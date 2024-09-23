@extends('adminlte::page')

@section('title', 'Resultado del examen')

@section('content_header')
    <h1>Resultados del examen: {{ $exam->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>¡Examen completado!</h3>
        </div>
        <div class="card-body">
            <p><strong>Puntaje del intento actual:</strong> {{ $score }}%</p>
            <p><strong>Preguntas correctas:</strong> {{ $correctAnswers }} de {{ $totalQuestions }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Historial de intentos</h4>
        </div>
        <div class="card-body">
            <ul>
                @php
                    // Obtener todos los intentos del usuario para este examen
                    $userAttempts = $exam->userAnswers()
                        ->where('user_id', auth()->id())
                        ->groupBy('attempt')
                        ->select('attempt')
                        ->get();
                @endphp

                @foreach($userAttempts as $attempt)
                    <li>Intento {{ $attempt->attempt }} -
                        @php
                            $correct = $exam->userAnswers()
                                ->where('user_id', auth()->id())
                                ->where('attempt', $attempt->attempt)
                                ->whereHas('question', function ($query) {
                                    $query->whereColumn('correct_answer', 'selected_option');
                                })
                                ->count();
                        @endphp
                        Correctas: {{ $correct }} de {{ $totalQuestions }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('exams.solve.index') }}" class="btn btn-primary mt-4">Volver a los exámenes</a>
@stop

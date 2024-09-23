@extends('adminlte::page')

@section('title', 'Editar pregunta')

@section('content_header')
    <h1>Editar pregunta para el examen: {{ $exam->title }}</h1>
@stop

@section('content')
    <form action="{{ route('questions.update', [$exam, $question]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="question_text">Texto de la pregunta:</label>
            <textarea name="question_text" class="form-control" required>{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        <div class="form-group">
            <label for="option_a">Opción A:</label>
            <input type="text" name="option_a" class="form-control" value="{{ old('option_a', $question->option_a) }}" required>
        </div>

        <div class="form-group">
            <label for="option_b">Opción B:</label>
            <input type="text" name="option_b" class="form-control" value="{{ old('option_b', $question->option_b) }}" required>
        </div>

        <div class="form-group">
            <label for="option_c">Opción C:</label>
            <input type="text" name="option_c" class="form-control" value="{{ old('option_c', $question->option_c) }}" required>
        </div>

        <div class="form-group">
            <label for="option_d">Opción D:</label>
            <input type="text" name="option_d" class="form-control" value="{{ old('option_d', $question->option_d) }}" required>
        </div>

        <div class="form-group">
            <label for="correct_answer">Respuesta correcta:</label>
            <select name="correct_answer" class="form-control" required>
                <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar pregunta</button>
        <a href="{{ route('questions.index', $exam) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

@extends('adminlte::page')

@section('title', 'Preguntas del examen')

@section('content_header')
    <h1>Preguntas para: {{ $exam->title }}</h1>
@stop

@section('content')
    <a href="{{ route('questions.create', $exam) }}" class="btn btn-primary">Añadir nueva pregunta</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Texto de la pregunta</th>
                <th>Opciones</th>
                <th>Respuesta correcta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question_text }}</td>
                    <td>
                        <strong>A:</strong> {{ $question->option_a }}<br>
                        <strong>B:</strong> {{ $question->option_b }}<br>
                        <strong>C:</strong> {{ $question->option_c }}<br>
                        <strong>D:</strong> {{ $question->option_d }}
                    </td>
                    <td>{{ $question->correct_answer }}</td>
                    <td>
                        <a href="{{ route('questions.edit', [$exam, $question]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('questions.destroy', [$exam, $question]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

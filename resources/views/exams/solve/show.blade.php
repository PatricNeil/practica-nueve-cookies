@extends('adminlte::page')

@section('title', 'Resolver examen')

@section('content_header')
    <h1>Examen: {{ $exam->title }}</h1>
@stop

@section('content')
    <form action="{{ route('exams.solve.submit', $exam) }}" method="POST">
        @csrf

        @foreach($questions as $question)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}_A" value="A" required>
                        <label class="form-check-label" for="question_{{ $question->id }}_A">
                            {{ $question->option_a }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}_B" value="B" required>
                        <label class="form-check-label" for="question_{{ $question->id }}_B">
                            {{ $question->option_b }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}_C" value="C" required>
                        <label class="form-check-label" for="question_{{ $question->id }}_C">
                            {{ $question->option_c }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="question_{{ $question->id }}_D" value="D" required>
                        <label class="form-check-label" for="question_{{ $question->id }}_D">
                            {{ $question->option_d }}
                        </label>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">Enviar respuestas</button>
    </form>
@stop

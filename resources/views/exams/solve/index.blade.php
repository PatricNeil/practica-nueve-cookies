@extends('adminlte::page')

@section('title', 'Seleccionar examen')

@section('content_header')
    <h1>Exámenes disponibles</h1>
@stop

@section('content')
    <div class="row">
        @if($exams->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning">
                    No hay exámenes disponibles en este momento.
                </div>
            </div>
        @else
            @foreach($exams as $exam)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $exam->title }}</h3>
                        </div>
                        <div class="card-body">
                            <p>{{ $exam->description }}</p>
                            <p><strong>Duración:</strong> {{ $exam->duration }} minutos</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('exams.solve.show', $exam) }}" class="btn btn-primary">Resolver examen</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@stop

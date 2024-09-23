@extends('adminlte::page')

@section('title', 'Editar examen')

@section('content_header')
    <h1>Editar examen: {{ $exam->title }}</h1>
@stop

@section('content')
    <form action="{{ route('exams.update', $exam) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título del examen:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $exam->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción (opcional):</label>
            <textarea name="description" class="form-control">{{ old('description', $exam->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="start_time">Fecha y hora de inicio:</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', $exam->start_time) }}" required>
        </div>

        <div class="form-group">
            <label for="end_time">Fecha y hora de fin:</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time', $exam->end_time) }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración (en minutos):</label>
            <input type="number" name="duration" class="form-control" value="{{ old('duration', $exam->duration) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar examen</button>
        <a href="{{ route('exams.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

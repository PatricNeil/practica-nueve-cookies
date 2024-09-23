@extends('adminlte::page')

@section('title', 'Crear nuevo examen')

@section('content_header')
    <h1>Crear nuevo examen</h1>
@stop

@section('content')
    <form action="{{ route('exams.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Título del examen:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción (opcional):</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="start_time">Fecha y hora de inicio:</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
        </div>

        <div class="form-group">
            <label for="end_time">Fecha y hora de fin:</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Duración (en minutos):</label>
            <input type="number" name="duration" class="form-control" value="{{ old('duration') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Crear examen</button>
        <a href="{{ route('exams.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop

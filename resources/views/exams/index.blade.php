@extends('adminlte::page')

@section('title', 'Exámenes')

@section('content_header')
    <h1>Exámenes</h1>
@stop

@section('content')
    <a href="{{ route('exams.create') }}" class="btn btn-primary">Crear nuevo examen</a>

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Duración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
                <tr>
                    <td>{{ $exam->title }}</td>
                    <td>{{ $exam->description }}</td>
                    <td>{{ $exam->duration }} minutos</td>
                    <td>
                        <a href="{{ route('exams.edit', $exam) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('exams.destroy', $exam) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                        <a href="{{ route('questions.index', $exam) }}" class="btn btn-info">Ver preguntas</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

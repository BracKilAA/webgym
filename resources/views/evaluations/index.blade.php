@extends('layouts.app')

@section('content')
<style>
        body {
        background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        min-height: 100vh;
        position: relative;
    }

    /* Animación del gradiente de fondo */
    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Overlay sutil para mejor legibilidad */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(0.5px);
        z-index: -1;
    }
nav[role="navigation"] {
    display: none;
}

</style>
<div class="container mt-4">
    <h1>Evaluaciones</h1>
    <a href="{{ route('evaluations.create') }}" class="btn btn-primary mb-3">Nueva Evaluación</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($evaluations->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Peso (kg)</th>
                    <th>Altura (cm)</th>
                    <th>IMC</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->user->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $evaluation->peso }}</td>
                    <td>{{ $evaluation->altura }}</td>
                    <td>{{ $evaluation->imc }}</td>
                    <td>
                        <a href="{{ route('evaluations.show', $evaluation) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('evaluations.edit', $evaluation) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('evaluations.destroy', $evaluation) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar evaluación?')" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

       
    @else
        <p>No hay evaluaciones registradas.</p>
    @endif
</div>
@endsection

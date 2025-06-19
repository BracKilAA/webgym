@extends('layouts.app')

@section('content')

<style>
        /* Background principal con gradiente animado */
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

</style>
<div class="card">
    <div class="card-header">
        <h4>Crear Nuevo Plan</h4>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('plans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Cliente</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Selecciona un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Duración (semanas)</label>
                <input type="number" name="duracion_semanas" class="form-control" value="{{ old('duracion_semanas') }}" min="1" required>
            </div>
            <div class="mb-3">
                <label>Sesiones por semana</label>
                <input type="number" name="sesiones_semana" class="form-control" value="{{ old('sesiones_semana') }}" min="1" required>
            </div>
            <div class="mb-3">
                <label>Fecha de inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
            </div>
           <div class="mb-3">
    <label for="ejercicios">Ejercicios</label>
    <textarea name="ejercicios" class="form-control" rows="5" required>{{ old('ejercicios') }}</textarea>
    <small class="form-text text-muted">Escribe uno por línea (ejemplo: Sentadillas, Prensa, Dominadas...)</small>
</div>

            <div class="mb-3">
                <label>¿Completado?</label>
                <select name="completado" class="form-select" required>
                    <option value="0" {{ old('completado') == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('completado') == 1 ? 'selected' : '' }}>Sí</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Plan</button>
            <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
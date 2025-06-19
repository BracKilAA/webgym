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
        <h4>Detalle del Plan</h4>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $plan->user->nombre }}</p>
        <p><strong>Nombre:</strong> {{ $plan->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $plan->descripcion }}</p>
        <p><strong>Duración (semanas):</strong> {{ $plan->duracion_semanas }}</p>
        <p><strong>Sesiones por semana:</strong> {{ $plan->sesiones_semana }}</p>
        <p><strong>Fecha de inicio:</strong> {{ \Carbon\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}</p>
        <p><strong>Completado:</strong> {{ $plan->completado ? 'Sí' : 'No' }}</p>
        <a href="{{ route('plans.index') }}" class="btn btn-secondary">Volver</a>
    </div>

<div class="mb-3">
    <label class="form-label"><strong>Ejercicios</strong></label>
    <pre>{{ is_array($plan->ejercicios) ? json_encode($plan->ejercicios, JSON_PRETTY_PRINT) : $plan->ejercicios }}</pre>
</div>

@endsection

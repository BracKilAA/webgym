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
        <h4>Detalle de Evaluación</h4>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $evaluation->user->nombre }}</p>
        <p><strong>Fecha Evaluación:</strong> {{ \Carbon\Carbon::parse($evaluation->fecha)->format('d/m/Y') }}</p>
        <p><strong>Peso (kg):</strong> {{ $evaluation->peso }}</p>
        <p><strong>Altura (cm):</strong> {{ $evaluation->altura }}</p>
        <p><strong>IMC:</strong> {{ number_format($evaluation->imc, 2) }}</p>
        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection

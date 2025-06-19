@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Seguimiento de {{ $user->nombre }}</h1>

    <section class="mb-6">
        <h2 class="text-xl font-semibold">Plan Actual</h2>
        @if($plan_actual)
            <p><strong>Nombre:</strong> {{ $plan_actual->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $plan_actual->descripcion }}</p>
            <p><strong>Fecha inicio:</strong> {{ \Carbon\Carbon::parse($plan_actual->fecha_inicio)->format('d/m/Y') }}</p>
            <p><strong>Duración (semanas):</strong> {{ $plan_actual->duracion_semanas }}</p>
            <p><strong>Sesiones por semana:</strong> {{ $plan_actual->sesiones_semana }}</p>
            <p><strong>Estado:</strong> {{ $plan_actual->completado ? 'Completado' : 'Activo' }}</p>
        @else
            <p>Este cliente no tiene un plan activo actualmente.</p>
        @endif
    </section>

    <section>
        <h2 class="text-xl font-semibold">Última Evaluación</h2>
        @if($ultima_evaluacion)
            <p><strong>Peso:</strong> {{ $ultima_evaluacion->peso }} kg</p>
            <p><strong>Altura:</strong> {{ $ultima_evaluacion->altura }} m</p>
            <p><strong>% Grasa corporal:</strong> {{ $ultima_evaluacion->porcentaje_grasa }}%</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ultima_evaluacion->created_at)->format('d/m/Y') }}</p>
            <p><strong>Circunferencias:</strong></p>
            <pre>{{ json_encode(json_decode($ultima_evaluacion->circunferencias), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        @else
            <p>No hay evaluaciones registradas para este cliente.</p>
        @endif
    </section>
</div>
@endsection

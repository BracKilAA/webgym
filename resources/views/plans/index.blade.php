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
 .card-header {
        background: rgba(255, 255, 255, 0.1) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        font-weight: 700;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
        position: relative;
        z-index: 2;
    }

    .card-header i {
        font-size: 1.6rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    /* Lista de elementos */
    ul.list-group.list-group-flush li.list-group-item {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: inherit;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: default;
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 8px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 2;
    }

    ul.list-group.list-group-flush li.list-group-item:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
     @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    /* Chart container con glassmorphism */
    .card > canvas {
        max-height: 350px;
        margin-top: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        position: relative;
        z-index: 2;
    }

    /* Delays de animación para efecto cascada */
    .col-md-4:nth-child(1) .card { animation-delay: 0.1s; }
    .col-md-4:nth-child(2) .card { animation-delay: 0.2s; }
    .col-md-4:nth-child(3) .card { animation-delay: 0.3s; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            margin: 10px;
            padding: 20px;
        }
        
        h1 {
            font-size: 2rem;
            padding: 15px;
        }
    }
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Lista de Planes</h4>
        <a href="{{ route('plans.create') }}" class="btn btn-success">Crear Nuevo Plan</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Nombre</th>
                    <th>Duración (semanas)</th>
                    <th>Sesiones/Semana</th>
                    <th>Fecha Inicio</th>
                    <th>Completado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>{{ $plan->user->nombre }}</td>
                        <td>{{ $plan->nombre }}</td>
                        <td>{{ $plan->duracion_semanas }}</td>
                        <td>{{ $plan->sesiones_semana }}</td>
                        <td>{{ \Carbon\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>
                            @if($plan->completado)
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-warning text-dark">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este plan?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No hay planes registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

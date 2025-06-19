@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Dashboard de Seguimiento</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="p-4 bg-blue-100 rounded shadow">
            <h2 class="text-lg font-semibold">Total de Clientes</h2>
            <p class="text-3xl">{{ $stats['total_clientes'] }}</p>
        </div>

        <div class="p-4 bg-green-100 rounded shadow">
            <h2 class="text-lg font-semibold">Planes Activos</h2>
            <p class="text-3xl">{{ $stats['planes_activos'] }}</p>
        </div>

        <div class="p-4 bg-yellow-100 rounded shadow">
            <h2 class="text-lg font-semibold">Evaluaciones Registradas</h2>
            <p class="text-3xl">{{ $stats['evaluaciones'] }}</p>
        </div>

        <div class="p-4 bg-purple-100 rounded shadow">
            <h2 class="text-lg font-semibold">Progreso General (%)</h2>
            <p class="text-3xl">{{ $stats['progreso_general'] }}%</p>
        </div>

    </div>
</div>
@endsection

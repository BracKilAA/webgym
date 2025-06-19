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
        <h4>Nueva Evaluación</h4>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evaluations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Cliente</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Selecciona un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Fecha Evaluación</label>
                <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
            </div>

            <div class="mb-3">
                <label>Peso (kg)</label>
                <input type="number" step="0.1" name="peso" class="form-control" value="{{ old('peso') }}" required>
            </div>

            <div class="mb-3">
                <label>Altura (cm)</label>
                <input type="number" step="0.1" name="altura" class="form-control" value="{{ old('altura') }}" required>
            </div>

            <div class="mb-3">
                <label>IMC</label>
                <input type="number" step="0.01" name="imc" class="form-control" value="" readonly>
            </div>

            <div class="mb-3">
                <label>Pecho (cm)</label>
                <input type="number" step="0.1" name="pecho" class="form-control" value="{{ old('pecho') }}" required>
            </div>

            <div class="mb-3">
                <label>Cintura (cm)</label>
                <input type="number" step="0.1" name="cintura" class="form-control" value="{{ old('cintura') }}" required>
            </div>

            <div class="mb-3">
                <label>Cadera (cm)</label>
                <input type="number" step="0.1" name="cadera" class="form-control" value="{{ old('cadera') }}" required>
            </div>

            <div class="mb-3">
                <label>Brazo (cm)</label>
                <input type="number" step="0.1" name="brazo" class="form-control" value="{{ old('brazo') }}" required>
            </div>

            <div class="mb-3">
                <label>Porcentaje de Grasa (%)</label>
                <input type="number" step="0.1" name="porcentaje_grasa" class="form-control" value="{{ old('porcentaje_grasa') }}" min="5" max="50" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
            <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

        <script>
            // Calcula IMC automáticamente al cambiar peso o altura
            const pesoInput = document.querySelector('input[name="peso"]');
            const alturaInput = document.querySelector('input[name="altura"]');
            const imcInput = document.querySelector('input[name="imc"]');

            function calcularIMC() {
                const peso = parseFloat(pesoInput.value);
                const alturaCm = parseFloat(alturaInput.value);
                if(peso > 0 && alturaCm > 0) {
                    const alturaM = alturaCm / 100;
                    const imc = peso / (alturaM * alturaM);
                    imcInput.value = imc.toFixed(2);
                } else {
                    imcInput.value = '';
                }
            }

            pesoInput.addEventListener('input', calcularIMC);
            alturaInput.addEventListener('input', calcularIMC);
        </script>
    </div>
</div>
@endsection

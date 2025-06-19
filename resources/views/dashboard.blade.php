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

    /* Container principal con backdrop blur */
    .container {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 30px;
        margin-top: 20px;
        margin-bottom: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Título principal con efecto glassmorphism */
    h1 {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        color: #fff;
        font-weight: 800;
        font-size: 2.5rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    /* Cards con glassmorphism mejorado */
    .card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        overflow: hidden;
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(20px);
        color: white !important;
        position: relative;
    }

    /* Efecto de brillo en las cards */
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
        z-index: 1;
    }

    .card:hover::before {
        left: 100%;
    }

    .card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        background: rgba(255, 255, 255, 0.25);
    }

    /* Cards específicas con colores sutiles */
    .card.bg-info {
        background: rgba(23, 162, 184, 0.2);
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    .card.bg-primary {
        background: rgba(0, 123, 255, 0.2);
        border: 1px solid rgba(0, 123, 255, 0.3);
    }

    .card.bg-warning {
        background: rgba(255, 193, 7, 0.2);
        border: 1px solid rgba(255, 193, 7, 0.3);
        color: #fff !important;
    }

    /* Headers de las cards */
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

    /* Resultado IMC con glassmorphism */
    #resultadoIMC {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.5s ease forwards;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    /* Formulario IMC */
    form#imcForm {
        position: relative;
        z-index: 2;
    }

    form#imcForm input.form-control, form#imcForm label {
        color: #fff;
        font-weight: 600;
    }

    form#imcForm input.form-control {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    form#imcForm input.form-control:focus {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        outline: none;
    }

    form#imcForm input.form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Botón con efecto neón */
    form#imcForm button.btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        border-radius: 12px;
        padding: 15px 35px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }

    form#imcForm button.btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    form#imcForm button.btn-primary:hover::before {
        left: 100%;
    }

    form#imcForm button.btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.6);
        background: linear-gradient(45deg, #764ba2, #667eea);
    }

    /* Títulos con glassmorphism */
    h4 {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 12px;
        padding: 15px 20px;
        font-weight: 800;
        color: #fff;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 2;
    }

    /* Animaciones */
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />

<div class="container mt-4">
    <h1>Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info mb-3">
                <div class="card-header"><i class="fas fa-users"></i> Últimos Clientes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ultimos_clientes->count() }}</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($ultimos_clientes as $cliente)
                            <li class="list-group-item">{{ $cliente->nombre }}</li>
                        @empty
                            <li class="list-group-item">No hay clientes recientes.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-primary mb-3">
                <div class="card-header"><i class="fas fa-calendar-alt"></i> Planes Próximos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $planes_proximos->count() }}</h5>
                    <ul class="list-group list-group-flush">
                        @forelse($planes_proximos as $plan)
                            <li class="list-group-item">
                                {{ $plan->nombre }} - {{ $plan->user->nombre }}<br>
                                <small>Inicio: {{ \Carbon\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}</small>
                            </li>
                        @empty
                            <li class="list-group-item">No hay planes próximos.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-warning mb-3">
                <div class="card-header"><i class="fas fa-exclamation-triangle"></i> Evaluaciones Pendientes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $evaluaciones_pendientes }}</h5>
                    <p>Clientes con planes activos desde hace más de un mes sin evaluación.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-3 mb-5">
        <h4>Resumen Gráfico</h4>
        <canvas id="dashboardChart"></canvas>
    </div>

    {{-- Calculadora IMC --}}
    <div class="card p-3 mb-5">
        <h4>Calculadora IMC</h4>
        <form id="imcForm" onsubmit="return calcularIMC(event)">
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" step="0.1" id="peso" class="form-control" required min="30" max="200" placeholder="Ej: 70">
            </div>
            <div class="mb-3">
                <label for="altura" class="form-label">Altura (cm)</label>
                <input type="number" step="0.1" id="altura" class="form-control" required min="100" max="250" placeholder="Ej: 174">
            </div>
            <button type="submit" class="btn btn-primary">Calcular IMC</button>
        </form>

        <div class="mt-3" id="resultadoIMC" style="display:none;">
            <h5>Resultado:</h5>
            <p id="valorIMC" class="fw-bold"></p>
            <p id="categoriaIMC"></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    const data = {
        labels: ['Últimos Clientes', 'Planes Próximos', 'Evaluaciones Pendientes'],
        datasets: [{
            label: 'Cantidad',
            data: [
                {{ $ultimos_clientes->count() }},
                {{ $planes_proximos->count() }},
                {{ $evaluaciones_pendientes }}
            ],
            backgroundColor: [
                'rgba(255, 255, 255, 0.2)',
                'rgba(255, 255, 255, 0.25)',
                'rgba(255, 255, 255, 0.3)'
            ],
            borderColor: [
                'rgba(255, 255, 255, 0.8)',
                'rgba(255, 255, 255, 0.8)',
                'rgba(255, 255, 255, 0.8)'
            ],
            borderWidth: 2
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: { weight: 'bold' },
                    bodyFont: { size: 14 },
                    borderColor: 'rgba(255,255,255,0.3)',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1,
                    ticks: {
                        color: '#ffffff',
                        font: {
                            size: 13,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.2)'
                    }
                },
                x: {
                    ticks: {
                        color: '#ffffff',
                        font: {
                            size: 13,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    };

    new Chart(ctx, config);

    function calcularIMC(event) {
        event.preventDefault();

        const peso = parseFloat(document.getElementById('peso').value);
        const alturaCm = parseFloat(document.getElementById('altura').value);
        const alturaM = alturaCm / 100;
        const imc = peso / (alturaM * alturaM);
        const imcRedondeado = imc.toFixed(2);

        let categoria = '';

        if (imc < 18.5) {
            categoria = 'Bajo peso';
        } else if (imc >= 18.5 && imc < 25) {
            categoria = 'Peso normal';
        } else if (imc >= 25 && imc < 30) {
            categoria = 'Sobrepeso';
        } else {
            categoria = 'Obesidad';
        }

        document.getElementById('valorIMC').textContent = `IMC: ${imcRedondeado}`;
        document.getElementById('categoriaIMC').textContent = `Categoría: ${categoria}`;
        document.getElementById('resultadoIMC').style.display = 'block';
    }
</script>
@endsection
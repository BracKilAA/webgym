@extends('layouts.app')

@section('title', 'Registrar Administrador')

@push('styles')
<style>
    body {
    position: relative;
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: url('https://t3.ftcdn.net/jpg/08/27/87/60/360_F_827876077_k0EWo3jSiWZPR8fRgsSbZFT9SkrozNuj.jpg') no-repeat center center fixed;
    background-size: cover;
    filter: blur(4px); 
    z-index: -1;
}
    body {
        background: linear-gradient(135deg, #1f4037, #99f2c8);
        font-family: 'Segoe UI', sans-serif;
        height: 100%;
        margin: 0;
    }

    html, body {
        height: 100%;
    }

    main.container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-card {
        background-color: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 420px;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-card h2 {
        margin-bottom: 1rem;
        text-align: center;
        color: #333;
    }

    .register-card label {
        display: block;
        margin-top: 1rem;
        color: #555;
    }

    .register-card input {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        margin-top: 0.3rem;
    }

    .register-card button {
        width: 100%;
        margin-top: 1.5rem;
        padding: 0.7rem;
        background-color: #1f4037;
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .register-card button:hover {
        background-color: #14532d;
    }

    .register-card a {
        display: block;
        margin-top: 1rem;
        text-align: center;
        color: #1f4037;
        text-decoration: none;
    }

    .register-card a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 70px);">
    <div class="register-card">
        <h2>Crear Administrador</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="email">Correo</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit">Registrar</button>

            <a href="{{ route('login') }}">¿Ya tienes cuenta? Iniciar sesión</a>
        </form>
    </div>
</div>
@endsection

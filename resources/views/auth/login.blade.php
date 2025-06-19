@extends('layouts.app')

@section('title', 'Iniciar Sesión')

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

.login-card {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    max-width: 400px;
    width: 100%;
    animation: fadeIn 0.6s ease-in-out;
}



    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .form-label {
        margin-top: 1rem;
        color: #555;
    }

    .form-control {
        border-radius: 0.5rem;
    }

    .btn-primary {
        width: 100%;
        margin-top: 1.5rem;
        padding: 0.7rem;
        border-radius: 0.5rem;
        background-color: #243B55;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #141E30;
    }

    .login-card a {
        display: block;
        margin-top: 1rem;
        text-align: center;
        color: #243B55;
        text-decoration: none;
    }

    .login-card a:hover {
        text-decoration: underline;
    }

    .error {
        color: red;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 140px);">
    <div class="login-card">
        <h2>Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email" class="form-label mt-2">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password" class="form-label mt-3">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-4 w-100">Entrar</button>

            <a href="{{ route('register') }}" class="d-block text-center mt-3">¿No tienes cuenta? Crear administrador</a>
        </form>
    </div>
</div>
@endsection



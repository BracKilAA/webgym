<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // 🚀 Formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 🚀 Lógica de registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create([
    'nombre' => $request->nombre,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'tipo' => 'admin',
    'user_code' => 'ADM-' . strtoupper(uniqid()),
    'fecha_inscripcion' => now(), // ✅ esta línea soluciona tu error
]);


        Auth::login($user);

        return redirect()->route('dashboard');
    }
}

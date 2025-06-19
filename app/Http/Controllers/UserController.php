<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $clientes = User::orderBy('nombre')->get();
        return view('users.index', compact('clientes'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'nullable|email|unique:users',
            'telefono' => 'nullable|string|max:20',
            'fecha_inscripcion' => 'required|date'
        ]);

        User::create($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'Cliente agregado correctamente');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'telefono' => 'nullable|string|max:20'
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'Cliente actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
                         ->with('success', 'Cliente eliminado');
    }
}
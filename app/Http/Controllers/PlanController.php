<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans.index', [
            'plans' => Plan::with('user')->get()
        ]);
    }

    public function create()
    {
        return view('plans.create', [
            'clientes' => User::all(),
            'ejercicios' => 'required|string'

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'duracion_semanas' => 'required|integer',
            'sesiones_semana' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'ejercicios' => 'nullable|string',
            'completado' => 'required|boolean',
        ]);

        Plan::create($data);

        return redirect()->route('plans.index')->with('success', 'Plan creado correctamente.');
    }

    public function show(Plan $plan)
    {
        return view('plans.show', [
            'plan' => $plan->load('user')
        ]);
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', [
            'plan' => $plan,
            'clientes' => User::all()
        ]);
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'duracion_semanas' => 'required|integer',
            'sesiones_semana' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'ejercicios' => 'nullable|string',
            'completado' => 'required|boolean',
        ]);

        $plan->update($data);

        return redirect()->route('plans.index')->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan eliminado correctamente.');
    }
}

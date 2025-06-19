<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with('user')->paginate(10);
        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        return view('evaluations.create', [
            'clientes' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'pecho' => 'required|numeric',
            'cintura' => 'required|numeric',
            'cadera' => 'required|numeric',
            'brazo' => 'required|numeric',
            'porcentaje_grasa' => 'required|numeric|min:5|max:50',
        ]);

        $validated['imc'] = $validated['peso'] / (($validated['altura'] / 100) ** 2);
        $validated['evaluation_code'] = 'EV-' . strtoupper(uniqid());

        Evaluation::create($validated);

        return redirect()->route('evaluations.index')->with('success', 'Evaluación guardada correctamente.');
    }

    public function show(Evaluation $evaluation)
    {
        return view('evaluations.show', compact('evaluation'));
    }

    public function edit(Evaluation $evaluation)
    {
        return view('evaluations.edit', [
            'evaluation' => $evaluation,
            'clientes' => User::all()
        ]);
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'pecho' => 'required|numeric',
            'cintura' => 'required|numeric',
            'cadera' => 'required|numeric',
            'brazo' => 'required|numeric',
            'porcentaje_grasa' => 'required|numeric|min:5|max:50',
        ]);

        $validated['imc'] = $validated['peso'] / (($validated['altura'] / 100) ** 2);

        $evaluation->update($validated);

        return redirect()->route('evaluations.index')->with('success', 'Evaluación actualizada correctamente.');
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('evaluations.index')->with('success', 'Evaluación eliminada correctamente.');
    }
}

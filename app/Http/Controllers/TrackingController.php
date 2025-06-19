<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plan;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_clientes' => User::count(),
            'planes_activos' => Plan::where('completado', false)->count(),
            'evaluaciones' => Evaluation::count(),
            'progreso_general' => $this->calculateGeneralProgress()
        ];

        return view('tracking.dashboard', compact('stats'));
    }

    public function clientTracking(User $user)
    {
        $plan_actual = $user->plans()->latest()->first();
        $ultima_evaluacion = $user->evaluations()->latest()->first();

        return view('tracking.client', compact('user', 'plan_actual', 'ultima_evaluacion'));
    }

    private function calculateGeneralProgress()
    {
        $totalPlanes = Plan::count();
        $planesCompletados = Plan::where('completado', true)->count();
        
        return $totalPlanes > 0 ? round(($planesCompletados / $totalPlanes) * 100) : 0;
    }
}
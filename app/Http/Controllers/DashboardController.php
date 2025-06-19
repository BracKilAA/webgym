<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Plan;
use App\Models\Evaluation;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $ultimos_clientes = User::where('tipo', 'cliente')
                                ->latest()
                                ->take(5)
                                ->get();

        
        $planes_proximos = Plan::with('user')
            ->whereDate('fecha_inicio', '>=', now())
            ->whereDate('fecha_inicio', '<=', now()->addDays(7))
            ->where('completado', false)
            ->orderBy('fecha_inicio')
            ->take(5)
            ->get();

        
        $evaluaciones_pendientes = User::where('tipo', 'cliente')
            ->whereHas('plans', function ($query) {
                $query->where('fecha_inicio', '<=', now()->subMonth())
                      ->where('completado', false);
            })
            ->whereDoesntHave('evaluations', function ($query) {
                $query->where('created_at', '>=', now()->subMonth());
            })
            ->count();

        return view('dashboard', compact(
            'ultimos_clientes',
            'planes_proximos',
            'evaluaciones_pendientes'
        ));
    }
}

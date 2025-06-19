<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    PlanController,
    EvaluationController,
    DashboardController,
    TrackingController,
    ClienteController,
    EvaluacionController
};

Route::get('/', function () {
    return redirect()->route('login'); 
});





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clientes', ClienteController::class);
    Route::resource('users', UserController::class);

    Route::resource('plans', PlanController::class);
    Route::post('plans/{plan}/complete', [PlanController::class, 'complete'])->name('plans.complete');

    Route::resource('evaluations', EvaluationController::class)->except(['edit', 'update', 'destroy']);
    Route::get('evaluations/compare/{user}', [EvaluationController::class, 'compare'])->name('evaluations.compare');
    Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::get('/evaluations/create/{user}', [EvaluationController::class, 'create'])->name('evaluations.create.user');
    Route::resource('evaluations', EvaluationController::class);

    Route::resource('evaluacions', EvaluacionController::class);
    Route::get('evaluaciones', [EvaluationController::class, 'index'])->name('evaluaciones.index');

    Route::get('tracking', [TrackingController::class, 'dashboard'])->name('tracking.dashboard');
    Route::get('tracking/{user}', [TrackingController::class, 'clientTracking'])->name('tracking.client');
});

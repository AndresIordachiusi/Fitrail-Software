<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Entrenador;
use App\Models\Entrenamiento;
use App\Models\Plan;
use App\Models\Reserva;
use App\Models\Sede;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalClients = Client::count();
        $totalEntrenadores = Entrenador::count();
        $totalSedes = Sede::count();
        $totalPlanes = Plan::count();
        $totalEntrenamientos = Entrenamiento::count();
        $totalReservas = Reserva::count();
        $reservasHoy = Reserva::whereDate('fecha_reserva', now()->toDateString())->count();

        $ultimasReservas = Reserva::with(['cliente', 'entrenamiento'])
            ->latest()
            ->take(6)
            ->get();

        $proximosEntrenamientos = Entrenamiento::with('entrenador')
            ->where('fecha_inicio', '>=', now())
            ->orderBy('fecha_inicio')
            ->take(5)
            ->get();

        $planesPopulares = Plan::withCount('clients')
            ->orderByDesc('clients_count')
            ->take(4)
            ->get();

        $ingresosPotenciales = $planesPopulares
            ->sum(fn($plan) => $plan->precio * $plan->clients_count);

        return view('admin.dashboard', compact(
            'totalClients',
            'totalEntrenadores',
            'totalSedes',
            'totalPlanes',
            'totalEntrenamientos',
            'totalReservas',
            'reservasHoy',
            'ultimasReservas',
            'proximosEntrenamientos',
            'planesPopulares',
            'ingresosPotenciales'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

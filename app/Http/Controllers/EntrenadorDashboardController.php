<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrenadorDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $entrenador = $user->entrenador;

        if (!$entrenador) {
            return view('entrenadors.dashboard', [
                'entrenamientos' => collect(),
                'misClases' => collect(),
            ]);
        }

        $entrenamientos = Entrenamiento::with('entrenador')
            ->where('entrenador_id', $entrenador->id)
            ->orderBy('fecha_inicio')
            ->get();

        $misClases = Reserva::with(['cliente', 'entrenamiento'])
            ->where('estado', 'confirmada')
            ->whereHas('entrenamiento', function ($query) use ($entrenador) {
                $query->where('entrenador_id', $entrenador->id);
            })
            ->latest('fecha_reserva')
            ->get();

        return view('entrenadors.dashboard', compact('entrenamientos', 'misClases'));
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

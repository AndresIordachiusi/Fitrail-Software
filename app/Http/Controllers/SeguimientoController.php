<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entrenador;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Seguimiento::with(['client', 'entrenador'])->latest('fecha_seguimiento');

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->integer('client_id'));
        }

        if ($request->filled('progreso')) {
            $query->where('progreso', $request->string('progreso'));
        }

        $seguimientos = $query->paginate(12)->withQueryString();

        $clients = Client::orderBy('nombre')->get();

        return view('seguimientos.index', [
            'seguimientos' => $seguimientos,
            'clients' => $clients,
            'filters' => $request->only(['client_id', 'progreso']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('nombre')->get();
        $entrenadors = Entrenador::orderBy('nombre')->get();

        return view('seguimientos.create', compact('clients', 'entrenadors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'entrenador_id' => 'nullable|exists:entrenadors,id',
            'fecha_seguimiento' => 'required|date',
            'peso' => 'nullable|numeric|min:30|max:300',
            'altura' => 'nullable|numeric|min:1.30|max:2.50',
            'nivel_energia' => 'required|integer|min:1|max:5',
            'adherencia' => 'required|integer|min:1|max:5',
            'progreso' => 'required|in:sin_cambios,mejorando,retroceso',
            'observaciones' => 'nullable|string|max:2000',
            'proximos_pasos' => 'nullable|string|max:2000',
        ]);

        $validated['imc'] = $this->calculateImc($validated['peso'] ?? null, $validated['altura'] ?? null);

        Seguimiento::create($validated);

        return redirect()->route('admin.seguimientos.index')->with('status', 'Seguimiento creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seguimiento $seguimiento)
    {
        $seguimiento->load(['client', 'entrenador']);

        return view('seguimientos.show', compact('seguimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seguimiento $seguimiento)
    {
        $clients = Client::orderBy('nombre')->get();
        $entrenadors = Entrenador::orderBy('nombre')->get();

        return view('seguimientos.update', compact('seguimiento', 'clients', 'entrenadors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seguimiento $seguimiento)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'entrenador_id' => 'nullable|exists:entrenadors,id',
            'fecha_seguimiento' => 'required|date',
            'peso' => 'nullable|numeric|min:30|max:300',
            'altura' => 'nullable|numeric|min:1.30|max:2.50',
            'nivel_energia' => 'required|integer|min:1|max:5',
            'adherencia' => 'required|integer|min:1|max:5',
            'progreso' => 'required|in:sin_cambios,mejorando,retroceso',
            'observaciones' => 'nullable|string|max:2000',
            'proximos_pasos' => 'nullable|string|max:2000',
        ]);

        $validated['imc'] = $this->calculateImc($validated['peso'] ?? null, $validated['altura'] ?? null);

        $seguimiento->update($validated);

        return redirect()->route('admin.seguimientos.index')->with('status', 'Seguimiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seguimiento $seguimiento)
    {
        $seguimiento->delete();

        return redirect()->route('admin.seguimientos.index')->with('status', 'Seguimiento eliminado correctamente.');
    }

    private function calculateImc($peso, $altura): ?float
    {
        if (!$peso || !$altura || $altura <= 0) {
            return null;
        }

        return round($peso / ($altura * $altura), 2);
    }
}

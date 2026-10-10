<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            $plans = Plan::all();
            return view('plans.index', compact('plans'));
        }

        if (auth()->check() && auth()->user()->role === 'client') {
            $planes = Plan::all();
            return view('plans.planClient', compact('planes'));
        }

        return redirect()->route('login');
    }

    public function plan()
    {
        $usurio = auth()->user();
        $cliente = $usurio->client;
        if ($cliente->plans()->count() > 0) {
            return redirect()->route('clients.dashboard');
        }

        $planes = Plan::all();
        return view('auth.register-plan', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'precio' => 'required|numeric|min:0|max:9999.99',
        ]);

        Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('status', 'Plan creado exitosamente'); //PRG
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
    public function edit(Plan $plan)
    {
        return view('plans.update', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'precio' => 'required|numeric|min:0|max:9999.99',
        ]);

        $plan->update($validated);

        return redirect()->route('admin.plans.index')->with('status', 'Plan actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('status', 'Plan eliminado exitosamente');
    }
}

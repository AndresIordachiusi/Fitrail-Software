<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reserva;
use App\Models\Entrenamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Hash

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view("clients.index", compact("clients")); // Pasar los clientes a la vista
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email',
            'edad' => 'required|integer|min:15',
            'altura' => 'required|numeric|min:1.40|max:2.10',
            'peso' => 'required|numeric|min:40|max:200',
            'objetivo' => 'required|in:perder peso,ganar masa muscular,tonificar,mantener forma,aumentar resistencia,mejorar flexibilidad,recomposición corporal',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Client::create($validated);

        return redirect()->route('clients.index');
    }

    public function reservar($clientId, $entrenamientoId)
    {
        $client = Client::findOrFail($clientId);
        $entrenamiento = Entrenamiento::findOrFail($entrenamientoId);

        if ($entrenamiento->capacidad > 0) {
            Reserva::create([
                'client_id' => $client->id,
                'entrenamiento_id' => $entrenamiento->id,
                'estado' => 'confirmada',
                'fecha_reserva' => now(),
            ]);
            $entrenamiento->decrement('capacidad'); // Reducir la capacidad del entrenamiento en 1
            return redirect()->back()->with('success', 'Reserva realizada con éxito.'); 
        } else {
            return redirect()->back()->with('error', 'No hay capacidad disponible para este entrenamiento.');
        }

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
        $client = Client::findOrFail($id);
        return view("clients.update", compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email,' . $id,
            'edad' => 'required|integer|min:15',
            'altura' => 'required|numeric|min:1.40|max:2.10',
            'peso' => 'required|numeric|min:40|max:200',
            'objetivo' => 'required|in:perder peso,ganar masa muscular,tonificar,mantener forma,aumentar resistencia,mejorar flexibilidad,recomposición corporal',
        ]);

        // Solo actualizar la contraseña si se rellena el campo
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $client->update($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index');
    }
}

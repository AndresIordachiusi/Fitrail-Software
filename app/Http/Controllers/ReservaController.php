<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Client;
use App\Models\Entrenamiento;

class ReservaController extends Controller
{

    public function index()
    {
        $reservas = Reserva::all();
        return view("reservas.index", compact("reservas"));
    }

    public function create()
    {
        $clientes = Client::all();
        $entrenamientos = Entrenamiento::all();
        return view("reservas.create", compact("clientes", "entrenamientos"));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            "client_id" => "required|exists:clients,id",
            "entrenamiento_id" => "required|exists:entrenamientos,id",
            "estado" => "required|in:confirmada,cancelada,asistio,no_asistio",
            "fecha_reserva" => "required|date",
        ]);

        Reserva::create($validated);
        return redirect()->route("admin.reservas.index")->with("status", "Reserva creada exitosamente");

    }

    public function edit(Reserva $reserva)
    {
        $clientes = Client::all();
        $entrenamientos = Entrenamiento::all();
        return view("reservas.update", compact("reserva", "clientes", "entrenamientos"));

    }

    public function update(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            "client_id" => "required|exists:clients,id",
            "entrenamiento_id" => "required|exists:entrenamientos,id",
            "estado" => "required|in:confirmada,cancelada,asistio,no_asistio",
            "fecha_reserva" => "required|date",
        ]);

        $reserva->update($validated);
        return redirect()->route("admin.reservas.index")->with("status", "editado correctamente");

    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route("admin.reservas.index")->with("status", "Eliminado correctamente");
    }
}

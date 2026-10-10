<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EntrenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrenadores = Entrenador::all();
        return view("entrenadors.index", compact("entrenadores")); // compact para pasar variables a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sedes = Sede::all(); // Obtener todas las sedes para el select en la vista create
        return view("entrenadors.create", compact("sedes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // store() se utiliza para manejar la lógica de almacenamiento de nuevos registros
    {
        $validated = $request->validate([

            "nombre" => "required|string|max:100",
            "apellido" => "required|string|max:100",
            "email" => "required|email|unique:users,email|unique:entrenadors,email",
            "telefono" => "required|string|",
            "direccion" => "required|string|",
            "especialidad" => "required|in:Musculación,CrossFit,Funcional,Yoga,Rehabilitación",
            "password" => "required|string|min:6",
            "sede_id" => "required|exists:sedes,id", // Verifica que la sede_id exista en la tabla sedes
        ]);

        $user = User::create([
            "name" => $validated["nombre"],
            "email" => $validated["email"],
            "password" => Hash::make($request->password),
            "role" => "entrenador"
        ]);

        $user->entrenador()->create([
            "nombre" => $validated["nombre"],
            "apellido" => $validated["apellido"],
            "email" => $validated["email"],
            "telefono" => $validated["telefono"],
            "direccion" => $validated["direccion"],
            "especialidad" => $validated["especialidad"],
            "sede_id" => $validated["sede_id"],
            "user_id" => $user->id
        ]);

        return redirect()->route("admin.entrenadors.index")->with("status", "Entrenador creado exitosamente");
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
    public function edit(Entrenador $entrenador)  // edit() se utiliza para mostrar el formulario de edición de un registro existente
    {
        $sedes = Sede::all();
        return view("entrenadors.update", compact("entrenador", "sedes"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrenador $entrenador)
    {

        $validated = $request->validate([

            "nombre" => "required|string|max:100",
            "email" => "required|email|unique:entrenadors,email," . $entrenador->id,
            "telefono" => "required|string|",
            "direccion" => "required|string|",
            "especialidad" => "required|in:Musculación,CrossFit,Funcional,Yoga,Rehabilitación",
            "password" => "required|string|min:6",
            "sede_id" => "required|exists:sedes,id" // Verifica que la sede_id exista en la tabla sedes
        ]);
        $entrenador->update($validated);
        return redirect()->route("admin.entrenadors.index")->with("status", "Entrenador actualizado exitosamente");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrenador $entrenador)
    {
        $entrenador->delete();
        return redirect()->route("admin.entrenadors.index")->with("status", "Entrenador eliminado exitosamente");

    }
}

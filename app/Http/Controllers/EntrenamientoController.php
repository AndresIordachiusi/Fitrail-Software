<?php


namespace App\Http\Controllers;


use App\Models\Entrenamiento;
use App\Models\Entrenador;
use Illuminate\Http\Request;


class EntrenamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrenamientos = Entrenamiento::all();
        return view("entrenamientos.index", compact("entrenamientos"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrenadors = Entrenador::all();
        return view("entrenamientos.create", compact("entrenadors"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "required|string|max:1000",
            "capacidad" => "required|integer|min:1|max:30",
            "fecha_inicio" => "required|date",
            "fecha_fin" => "required|date|after:fecha_inicio",
            "entrenador_id" => "required|exists:entrenadors,id"
        ]);


        Entrenamiento::create($validated);

        if (auth()->user()->role === 'admin') {
            return redirect()->route("admin.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
        } else {
            return redirect()->route("entrenador.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
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
    public function edit(Entrenamiento $entrenamiento)
    {
        $entrenadors = Entrenador::all();
        return view('entrenamientos.update', compact('entrenamiento', 'entrenadors'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrenamiento $entrenamiento)
    {

        $validated = $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "required|string|max:1000",
            "capacidad" => "required|integer|min:1|max:30",
            "fecha_inicio" => "required|date",
            "fecha_fin" => "required|date|after:fecha_inicio",
            "entrenador_id" => "required|exists:entrenadors,id"
        ]);

        $entrenamiento->update($validated);
         if (auth()->user()->role === 'admin') {
            return redirect()->route("admin.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
        } else {
            return redirect()->route("entrenador.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrenamiento $entrenamiento)
    {

        $entrenamiento->delete();
         if (auth()->user()->role === 'admin') {
            return redirect()->route("admin.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
        } else {
            return redirect()->route("entrenador.entrenamientos.index")->with("status", "Entrenamiento creado exitosamente");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Reserva;
use App\Models\Seguimiento;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ClientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $client = $user->client;
        $reservas = Reserva::with(['entrenamiento.entrenador'])
            ->where('client_id', $client->id)
            ->where('estado', '!=', 'cancelada')
            ->get(); // Reservas activas/visibles en dashboard (sin canceladas)

        // Excluir entrenamientos que el cliente ya reservó
        $entrenamientosReservadosIds = $reservas
            ->where('estado', 'confirmada')
            ->pluck('entrenamiento_id'); // Excluir solo entrenamientos con reserva confirmada

        $entrenamientos = Entrenamiento::where('capacidad', '>', 0)
            ->where('fecha_inicio', '>=', now())
            ->whereNotIn('id', $entrenamientosReservadosIds) // Excluir entrenamientos ya reservados
            ->get();

        $planActivo = $client->plans()
            ->wherePivot('estado', 'Activo')
            ->latest('client_plan.fecha_inicio') // Obtener el plan activo más reciente
            ->first(); 

        if (!$planActivo) {
            $planes = Plan::all();
            return view('plans.planClient', compact('planes'))->with('error', 'Tu plan no está activo. Por favor, contacta con el gimnasio para más información.');
        }

        $sesionesCompletadas = Reserva::where('client_id', $client->id)
            ->where('estado', 'asistio')
            ->count();

        $registrosPeso = Seguimiento::where('client_id', $client->id)
            ->whereNull('entrenador_id')
            ->where('observaciones', 'like', 'Auto-registro de peso%')
            ->orderBy('fecha_seguimiento')
            ->orderBy('id')
            ->get(['peso']);

        $labels = ['Sesión 0'];
        $pesoSerie = [(float) $client->peso];

        $registrosUtiles = min($sesionesCompletadas, $registrosPeso->count());

        for ($i = 1; $i <= $registrosUtiles; $i++) {
            $labels[] = 'Sesión ' . $i;
            $pesoSerie[] = (float) $registrosPeso[$i - 1]->peso;
        }

        $chart = Chartjs::build()
            ->name('PesoSesionesChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'label' => 'Peso (kg)',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.2)',
                    'borderColor' => 'rgba(139, 92, 246, 1)',
                    'pointBackgroundColor' => 'rgba(99, 102, 241, 1)',
                    'pointBorderColor' => '#fff',
                    'pointRadius' => 4,
                    'tension' => 0.25,
                    'fill' => true,
                    'data' => $pesoSerie,
                ],
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Número de sesiones completadas',
                        ],
                    ],
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Peso (kg)',
                        ],
                        'beginAtZero' => false,
                    ],
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Evolución de peso por sesiones completadas',
                    ],
                ],
            ]);

        $registrosPesoPendientes = max(0, $sesionesCompletadas - $registrosPeso->count());

        return view('clients.dashboard', compact('entrenamientos', 'reservas', 'chart', 'sesionesCompletadas', 'registrosPesoPendientes'));

    }

    public function registrarPesoSesion(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;

        $validated = $request->validate([
            'peso' => 'required|numeric|min:30|max:300',
        ]);

        $sesionesCompletadas = Reserva::where('client_id', $client->id)
            ->where('estado', 'asistio')
            ->count();

        if ($sesionesCompletadas === 0) {
            return redirect()->route('clients.dashboard')->with('error', 'Aún no tienes sesiones completadas para registrar peso.');
        }

        $registrosPesoQuery = Seguimiento::where('client_id', $client->id)
            ->whereNull('entrenador_id')
            ->where('observaciones', 'like', 'Auto-registro de peso%');

        $registrosPesoCount = $registrosPesoQuery->count();

        if ($registrosPesoCount >= $sesionesCompletadas) {
            return redirect()->route('clients.dashboard')->with('error', 'Ya has registrado peso para todas tus sesiones completadas.');
        }

        $ultimoSeguimiento = (clone $registrosPesoQuery)
            ->latest('fecha_seguimiento')
            ->latest('id')
            ->first();

        $pesoAnterior = $ultimoSeguimiento?->peso ?? $client->peso;
        $nuevoPeso = (float) $validated['peso'];

        Seguimiento::create([
            'client_id' => $client->id,
            'entrenador_id' => null,
            'fecha_seguimiento' => now()->toDateString(),
            'peso' => $nuevoPeso,
            'altura' => $client->altura,
            'imc' => $this->calculateImc($nuevoPeso, $client->altura),
            'nivel_energia' => 3,
            'adherencia' => 3,
            'progreso' => $this->determineProgress($pesoAnterior, $nuevoPeso),
            'observaciones' => 'Auto-registro de peso tras sesión completada',
            'proximos_pasos' => null,
        ]);

        $client->update(['peso' => $nuevoPeso]);

        return redirect()->route('clients.dashboard')->with('status', 'Peso registrado correctamente para tu siguiente sesión completada.');
    }

    private function calculateImc(?float $peso, $altura): ?float
    {
        if (!$peso || !$altura || $altura <= 0) {
            return null;
        }

        return round($peso / ($altura * $altura), 2);
    }

    private function determineProgress($pesoAnterior, $pesoNuevo): string
    {
        if (!$pesoAnterior || $pesoAnterior == $pesoNuevo) {
            return 'sin_cambios';
        }

        return $pesoNuevo < $pesoAnterior ? 'mejorando' : 'retroceso';
    }

    public function reservas()
    {
        $user = Auth::user();
        $client = $user->client;

        $estado = request('estado', 'todas');

        $query = Reserva::with(['entrenamiento.entrenador'])
            ->where('client_id', $client->id);

        if (in_array($estado, ['confirmada', 'cancelada'], true)) {
            $query->where('estado', $estado);
        }

        $reservas = $query->latest('fecha_reserva')->get();

        return view('clients.reservas', compact('reservas', 'estado'));
    }

    public function cancelarReserva(Reserva $reserva)
    {
        $user = Auth::user();
        $client = $user->client;

        if ($reserva->client_id !== $client->id) {
            abort(403, 'No tienes permisos para cancelar esta reserva.');
        }

        if ($reserva->estado !== 'confirmada') {
            return redirect()->route('clients.reservas')->with('error', 'Solo se pueden cancelar reservas confirmadas.');
        }

        $reserva->update(['estado' => 'cancelada']);

        if ($reserva->entrenamiento) {
            $reserva->entrenamiento->increment('capacidad');
        }

        return redirect()->route('clients.reservas')->with('success', 'Reserva cancelada correctamente.');
    }
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Entrenamiento;

class DialogflowController extends Controller
{

    public function handle(Request $request)
    {
        // Verifica que haya un intent detectado

        $intent = $request->input('queryResult.intent.displayName', null);


        if (!$intent) {
            return response()->json([
                'fulfillmentText' => 'No pude entender tu intención '
            ]);
        }

        // Switch simple según intent
        switch ($intent) {

            case 'Hola':

                $message = '¡Hola!, ¿En qué puedo ayudarte hoy? ';
                break;

            case 'ver_planes':
                $plans = Plan::all();
                $message = "Nuestros planes disponibles son:\n";
                foreach ($plans as $plan) {
                    $message .= "- {$plan->nombre}: {$plan->descripcion} por \${$plan->precio}\n,";
                }

                break;
            // case 'recomendar_plan':
            //     $message = 'Te recomiendo el plan premium para ganar músculo ';
            //     break;

            case 'clases_hoy':

                $clases = Entrenamiento::all();

                if ($clases->isEmpty()) {
                    $message = "Hoy no hay clases programadas.";
                } else {
                    $message = "Las siguientes clases son:";

                    foreach ($clases as $clase) {
                        $message .= "- {$clase->nombre} (empieza {$clase->fecha_inicio})\n";
                    }
                }
                break;

            case 'comprar_plan':
                $message = 'Puedes comprar tu plan aquí: https://tuweb.com/pago';
                break;

            default:
                $message = 'No entendí tu pregunta 😅';
        }

        return response()->json([
            'fulfillmentText' => $message
        ]);
    }
}
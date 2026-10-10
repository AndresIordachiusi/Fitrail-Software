<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientHasPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'client') {
            return $next($request);
        }

        $client = $user->client;

        if (!$client) {
            abort(403, 'Cliente no asociado al usuario.');
        }

        if (!$client->plans()->exists()) {
            return redirect()->route('clients.paso-2')
                ->with('error', 'Debes adquirir un plan para continuar.');
        }

        return $next($request);
    }
}
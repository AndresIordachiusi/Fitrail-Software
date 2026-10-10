<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // Obtener el usuario autenticado
        $user = Auth::user();

        switch ($user->role) {

            case "admin":
                return redirect()->route('admin.dashboard');
            case "client":
                if (!$user->client || !$user->client->plans()->exists()) {
                    return redirect()->route('clients.paso-2');
                }

                return redirect()->route('clients.dashboard');
            case "entrenador":
                return redirect()->route('entrenadors.dashboard');
        }
        // Fallback por si no tiene rol definido
        return redirect()->route('dashboard');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

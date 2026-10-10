<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use app\Models\Client;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $rules = [
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ];

        // Validador del Admin

        if ($user->role === 'admin') {
            $rules += [
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            ];
        }
        // validador de cliente
        if ($user->role === 'client') {
            $rules += [
                'name' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'edad' => ['required', 'integer', 'min:0'],
                'altura' => ['required', 'integer', 'min:130'],
                'peso' => ['required', 'numeric', 'min:0'],
                'objetivo' => ['required', 'in:perder peso,ganar masa muscular,tonificar,mantener forma,aumentar resistencia,mejorar flexibilidad,recomposición corporal'],
            ];
        }

        // validador de entrenador
        if ($user->role === 'entrenador') {
            $rules += [
                'name' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            ];
        }

        // Validar los datos
        $validated = $request->validate($rules);

        // Actualiza User (email)
        $user->email = $validated['email'];

        // 
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        // Actualiza tabla específica por rol
        if ($user->role === 'client') {
            $client = $user->client; // <- puede ser null si no existe
            if (!$client) {
                abort(403, 'Este usuario no tiene perfil de cliente asociado.');
            }

            $client->update([
                'nombre' => $validated['name'],
                'apellido' => $validated['apellido'],
                'email' => $validated['email'],
                'edad' => $validated['edad'],
                'altura' => $validated['altura'],
                'peso' => $validated['peso'],
                'objetivo' => $validated['objetivo'],
            ]);
            // Actualizar el nombre del usuario
            $user->update([
                'name' => $validated['name'],
            ]);
        }

        if ($user->role === 'entrenador') {
            $entrenador = $user->entrenador;
            if (!$entrenador) {
                abort(403, 'Este usuario no tiene perfil de entrenador asociado.');
            }

            $entrenador->update([
                'nombre' => $validated['name'],
                'apellido' => $validated['apellido'],
                "email" => $validated['email']
            ]);

            $user->update([
                'name' => $validated['name'],
            ]);
        }

        $user->update([
            'email' => $validated['email']
        ]);

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

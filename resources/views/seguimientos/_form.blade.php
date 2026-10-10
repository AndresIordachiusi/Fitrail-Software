@csrf

@php
    $seguimientoActual = $seguimiento ?? null;
    $fechaSeguimiento = old(
        'fecha_seguimiento',
        $seguimientoActual?->fecha_seguimiento?->format('Y-m-d') ?? now()->format('Y-m-d')
    );
    $progresoActual = old('progreso', $seguimientoActual?->progreso ?? 'sin_cambios');
@endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div>
        <label for="client_id" class="mb-1 block text-sm text-zinc-300">Cliente</label>
        <select id="client_id" name="client_id"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none"
            required>
            <option value="">Selecciona un cliente</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}"
                    {{ (string) old('client_id', $seguimientoActual?->client_id ?? '') === (string) $client->id ? 'selected' : '' }}>
                    {{ $client->nombre }} {{ $client->apellido }}
                </option>
            @endforeach
        </select>
        @error('client_id')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="entrenador_id" class="mb-1 block text-sm text-zinc-300">Entrenador (opcional)</label>
        <select id="entrenador_id" name="entrenador_id"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none">
            <option value="">Sin entrenador asignado</option>
            @foreach ($entrenadors as $entrenador)
                <option value="{{ $entrenador->id }}"
                    {{ (string) old('entrenador_id', $seguimientoActual?->entrenador_id ?? '') === (string) $entrenador->id ? 'selected' : '' }}>
                    {{ $entrenador->nombre }} {{ $entrenador->apellido }}
                </option>
            @endforeach
        </select>
        @error('entrenador_id')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="fecha_seguimiento" class="mb-1 block text-sm text-zinc-300">Fecha de seguimiento</label>
        <input type="date" id="fecha_seguimiento" name="fecha_seguimiento"
            value="{{ $fechaSeguimiento }}"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none"
            required>
        @error('fecha_seguimiento')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="progreso" class="mb-1 block text-sm text-zinc-300">Estado de progreso</label>
        <select id="progreso" name="progreso"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none"
            required>
            <option value="sin_cambios" {{ $progresoActual === 'sin_cambios' ? 'selected' : '' }}>Sin cambios</option>
            <option value="mejorando" {{ $progresoActual === 'mejorando' ? 'selected' : '' }}>Mejorando</option>
            <option value="retroceso" {{ $progresoActual === 'retroceso' ? 'selected' : '' }}>Retroceso</option>
        </select>
        @error('progreso')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="peso" class="mb-1 block text-sm text-zinc-300">Peso (kg)</label>
        <input type="number" step="0.01" min="30" max="300" id="peso" name="peso"
            value="{{ old('peso', $seguimientoActual?->peso ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none">
        @error('peso')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="altura" class="mb-1 block text-sm text-zinc-300">Altura (m)</label>
        <input type="number" step="0.01" min="1.3" max="2.5" id="altura" name="altura"
            value="{{ old('altura', $seguimientoActual?->altura ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none">
        @error('altura')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="nivel_energia" class="mb-1 block text-sm text-zinc-300">Nivel de energía (1-5)</label>
        <input type="number" min="1" max="5" id="nivel_energia" name="nivel_energia"
            value="{{ old('nivel_energia', $seguimientoActual?->nivel_energia ?? 3) }}"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none"
            required>
        @error('nivel_energia')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="adherencia" class="mb-1 block text-sm text-zinc-300">Adherencia al plan (1-5)</label>
        <input type="number" min="1" max="5" id="adherencia" name="adherencia"
            value="{{ old('adherencia', $seguimientoActual?->adherencia ?? 3) }}"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none"
            required>
        @error('adherencia')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="observaciones" class="mb-1 block text-sm text-zinc-300">Observaciones</label>
        <textarea id="observaciones" name="observaciones" rows="4"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none">{{ old('observaciones', $seguimientoActual?->observaciones ?? '') }}</textarea>
        @error('observaciones')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="proximos_pasos" class="mb-1 block text-sm text-zinc-300">Próximos pasos</label>
        <textarea id="proximos_pasos" name="proximos_pasos" rows="4"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white focus:border-violet-400 focus:outline-none">{{ old('proximos_pasos', $seguimientoActual?->proximos_pasos ?? '') }}</textarea>
        @error('proximos_pasos')
            <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-2">
    <a href="{{ route('admin.seguimientos.index') }}"
        class="rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-sm text-zinc-200 hover:bg-white/10">
        Cancelar
    </a>
    <button type="submit"
        class="rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-violet-500">
        {{ $buttonText }}
    </button>
</div>

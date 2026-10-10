<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Cliente</label>
        <select name="client_id" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('client_id', $reserva->client_id ?? '') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
        @error('client_id') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Entrenamiento</label>
        <select name="entrenamiento_id" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            @foreach ($entrenamientos as $entrenamiento)
                <option value="{{ $entrenamiento->id }}" {{ old('entrenamiento_id', $reserva->entrenamiento_id ?? '') == $entrenamiento->id ? 'selected' : '' }}>
                    {{ $entrenamiento->nombre }}
                </option>
            @endforeach
        </select>
        @error('entrenamiento_id') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Estado</label>
        <select name="estado" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            <option value="confirmada" {{ old('estado', $reserva->estado ?? '') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
            <option value="cancelada" {{ old('estado', $reserva->estado ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            <option value="asistio" {{ old('estado', $reserva->estado ?? '') == 'asistio' ? 'selected' : '' }}>Asistió</option>
            <option value="no_asistio" {{ old('estado', $reserva->estado ?? '') == 'no_asistio' ? 'selected' : '' }}>No asistió</option>
        </select>
        @error('estado') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Fecha de reserva</label>
        <input type="datetime-local" name="fecha_reserva"
            value="{{ old('fecha_reserva', isset($reserva->fecha_reserva) ? date('Y-m-d\TH:i', strtotime($reserva->fecha_reserva)) : '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('fecha_reserva') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        {{ isset($reserva->id) ? 'Actualizar reserva' : 'Crear reserva' }}
    </button>
</div>
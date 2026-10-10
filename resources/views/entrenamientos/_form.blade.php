<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $entrenamiento->nombre ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('nombre') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Capacidad</label>
        <input type="number" name="capacidad" value="{{ old('capacidad', $entrenamiento->capacidad ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('capacidad') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-200">Descripción</label>
        <textarea name="descripcion" rows="3"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">{{ old('descripcion', $entrenamiento->descripcion ?? '') }}</textarea>
        @error('descripcion') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Fecha de inicio</label>
        <input type="datetime-local" name="fecha_inicio"
            value="{{ old('fecha_inicio', isset($entrenamiento->fecha_inicio) ? date('Y-m-d\TH:i', strtotime($entrenamiento->fecha_inicio)) : '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('fecha_inicio') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Fecha de fin</label>
        <input type="datetime-local" name="fecha_fin"
            value="{{ old('fecha_fin', isset($entrenamiento->fecha_fin) ? date('Y-m-d\TH:i', strtotime($entrenamiento->fecha_fin)) : '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('fecha_fin') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-200">Entrenador</label>
        <select name="entrenador_id" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            @foreach ($entrenadors as $entrenador)
                <option value="{{ $entrenador->id }}" {{ old('entrenador_id', $entrenamiento->entrenador_id ?? '') == $entrenador->id ? 'selected' : '' }}>
                    {{ $entrenador->nombre }}
                </option>
            @endforeach
        </select>
        @error('entrenador_id') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        {{ isset($entrenamiento->id) ? 'Actualizar entrenamiento' : 'Crear entrenamiento' }}
    </button>
</div>
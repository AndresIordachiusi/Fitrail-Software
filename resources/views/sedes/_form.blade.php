<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-200">Dirección</label>
        <input type="text" name="direccion" value="{{ old('direccion', $sede->direccion ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('direccion') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono', $sede->telefono ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('telefono') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Ciudad</label>
        <select name="ciudad" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            <option value="Tarragona" {{ old('ciudad', $sede->ciudad ?? '') == 'Tarragona' ? 'selected' : '' }}>Tarragona</option>
            <option value="Barcelona" {{ old('ciudad', $sede->ciudad ?? '') == 'Barcelona' ? 'selected' : '' }}>Barcelona</option>
        </select>
        @error('ciudad') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Horario de apertura</label>
        <input type="time" name="horario_apertura" value="{{ old('horario_apertura', $sede->horario_apertura ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('horario_apertura') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Horario de cierre</label>
        <input type="time" name="horario_cierre" value="{{ old('horario_cierre', $sede->horario_cierre ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('horario_cierre') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        {{ isset($sede->id) ? 'Actualizar sede' : 'Guardar sede' }}
    </button>
</div>
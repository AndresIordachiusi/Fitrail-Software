<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $entrenador->nombre ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('nombre') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

     <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Apellido</label>
        <input type="text" name="apellido" value="{{ old('apellido', $entrenador->apellido ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('apellido') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Email</label>
        <input type="email" name="email" value="{{ old('email', $entrenador->email ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('email') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono', $entrenador->telefono ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('telefono') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Dirección</label>
        <input type="text" name="direccion" value="{{ old('direccion', $entrenador->direccion ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
        @error('direccion') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Especialidad</label>
        <select name="especialidad" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            <option value="Musculación" {{ old('especialidad', $entrenador->especialidad ?? '') == 'Musculación' ? 'selected' : '' }}>Musculación</option>
            <option value="CrossFit" {{ old('especialidad', $entrenador->especialidad ?? '') == 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
            <option value="Funcional" {{ old('especialidad', $entrenador->especialidad ?? '') == 'Funcional' ? 'selected' : '' }}>Funcional</option>
            <option value="Yoga" {{ old('especialidad', $entrenador->especialidad ?? '') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
            <option value="Rehabilitación" {{ old('especialidad', $entrenador->especialidad ?? '') == 'Rehabilitación' ? 'selected' : '' }}>Rehabilitación</option>
        </select>
        @error('especialidad') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Sede</label>
        <select name="sede_id" class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
            <option value="">Selecciona...</option>
            @foreach($sedes as $sede)
                <option value="{{ $sede->id }}" {{ old('sede_id', $entrenador->sede_id ?? '') == $sede->id ? 'selected' : '' }}>
                    {{ $sede->ciudad }} - {{ $sede->direccion }}
                </option>
            @endforeach
        </select>
        @error('sede_id') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="mb-2 block text-sm font-medium text-zinc-200">Contraseña</label>
    <input type="password" name="password"
        class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
    @error('password') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        {{ isset($entrenador->id) ? 'Actualizar entrenador' : 'Guardar entrenador' }}
    </button>
</div>
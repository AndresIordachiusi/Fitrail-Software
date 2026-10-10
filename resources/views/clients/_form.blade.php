<style>
    .client-form-field {
        color: #fff !important;
        -webkit-text-fill-color: #fff !important;
    }

    .client-form-field::placeholder {
        color: #71717a;
        -webkit-text-fill-color: #71717a;
    }
</style>

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}"
            class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
        @error('nombre') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
            class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
        @error('email') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Edad</label>
        <input type="number" name="edad" value="{{ old('edad') }}"
            class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
        @error('edad') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Objetivo</label>
        <select name="objetivo"
            class="client-form-field w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60"
            style="color: #fff;">
            <option value="" style="color: #fff; background-color: #18181b;">Selecciona...</option>
            <option value="perder peso" {{ old('objetivo') == 'perder peso' ? 'selected' : '' }}>Perder peso</option>
            <option value="ganar masa muscular" {{ old('objetivo') == 'ganar masa muscular' ? 'selected' : '' }}>Ganar masa muscular</option>
            <option value="tonificar" {{ old('objetivo') == 'tonificar' ? 'selected' : '' }}>Tonificar</option>
            <option value="mantener forma" {{ old('objetivo') == 'mantener forma' ? 'selected' : '' }}>Mantener forma</option>
            <option value="aumentar resistencia" {{ old('objetivo') == 'aumentar resistencia' ? 'selected' : '' }}>Aumentar resistencia</option>
            <option value="mejorar flexibilidad" {{ old('objetivo') == 'mejorar flexibilidad' ? 'selected' : '' }}>Mejorar flexibilidad</option>
            <option value="recomposición corporal" {{ old('objetivo') == 'recomposición corporal' ? 'selected' : '' }}>Recomposición corporal</option>
        </select>
        @error('objetivo') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Altura (m)</label>
        <input type="number" name="altura" step="0.01" value="{{ old('altura') }}"
            class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
        @error('altura') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Peso (kg)</label>
        <input type="number" name="peso" step="0.01" value="{{ old('peso') }}"
            class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
        @error('peso') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="mb-2 block text-sm font-medium text-zinc-200">Contraseña</label>
    <input type="password" name="password"
        class="client-form-field w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-zinc-100 placeholder-zinc-500 outline-none transition focus:border-violet-400/60">
    @error('password') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        Guardar cliente
    </button>
</div>

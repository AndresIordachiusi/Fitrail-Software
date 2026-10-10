<div class="grid grid-cols-1 gap-5">
	<div>
		<label class="mb-2 block text-sm font-medium text-zinc-200">Nombre del plan</label>
		<input type="text" name="nombre" value="{{ old('nombre', $plan->nombre ?? '') }}"
			class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
		@error('nombre') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
	</div>

	<div>
		<label class="mb-2 block text-sm font-medium text-zinc-200">Descripción</label>
		<textarea name="descripcion" rows="4"
			class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">{{ old('descripcion', $plan->descripcion ?? '') }}</textarea>
		@error('descripcion') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
	</div>

	<div>
		<label class="mb-2 block text-sm font-medium text-zinc-200">Precio (€)</label>
		<input type="number" step="0.01" name="precio" value="{{ old('precio', $plan->precio ?? '') }}"
			class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60">
		@error('precio') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
	</div>
</div>

<div class="pt-2">
	<button type="submit"
		class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
		{{ isset($plan->id) ? 'Actualizar plan' : 'Crear plan' }}
	</button>
</div>
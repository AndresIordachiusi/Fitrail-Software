<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60" required>
        @error('name') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60" required>
        @error('email') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Rol</label>
        <select name="role"
            class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-white outline-none transition focus:border-violet-400/60" required>
            <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>admin</option>
            <option value="client" {{ old('role', $user->role ?? '') === 'client' ? 'selected' : '' }}>client</option>
            <option value="entrenador" {{ old('role', $user->role ?? '') === 'entrenador' ? 'selected' : '' }}>entrenador</option>
        </select>
        @error('role') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-end">
        <label class="inline-flex items-center gap-2 text-sm text-zinc-300">
            <input type="checkbox" name="email_verified" value="1"
                {{ old('email_verified', isset($user) && $user->email_verified_at ? 1 : 0) ? 'checked' : '' }}
                class="rounded border-white/20 bg-white/5 text-violet-500 focus:ring-violet-500">
            Marcar email como verificado
        </label>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">
            Contraseña {{ isset($user) ? '(opcional)' : '' }}
        </label>
        <input type="password" name="password"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60"
            {{ isset($user) ? '' : 'required' }}>
        @error('password') <p class="mt-1 text-xs text-white">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-200">Confirmar contraseña</label>
        <input type="password" name="password_confirmation"
            class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-white outline-none transition focus:border-violet-400/60"
            {{ isset($user) ? '' : 'required' }}>
    </div>
</div>

<div class="pt-2">
    <button type="submit"
        class="inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-violet-500 md:w-auto">
        {{ $submitText ?? 'Guardar usuario' }}
    </button>
</div>

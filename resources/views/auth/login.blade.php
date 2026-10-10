<x-guest-layout>
    <div class="w-full max-w-2xl pt-6">
        <div class="mx-auto mb-8 flex items-center justify-center gap-2 text-4xl font-semibold tracking-tight">
            <span class="text-3xl">Inicia Sesión en Fitrail</span>
        </div>

        <div class="relative mx-auto w-full max-w-xl">
            <div class="h-px w-full bg-gradient-to-r from-transparent via-violet-300 to-transparent"></div>
            <div
                class="mx-2 mt-0 rounded-xl border border-white/10 bg-zinc-900  shadow-[0_0_30px_0_rgba(255,255,255,0.08)] sm:mx-0">
                <div class="p-6">
                    <h3 class="text-3xl font-semibold tracking-tight text-white">Iniciar sesión</h3>
                    <p class="mt-1.5 text-sm text-white/50">Bienvenido de nuevo, por favor ingresa tus credenciales.</p>
                </div>

                <div class="p-6 pt-0">
                    <x-auth-session-status class="mb-4 text-sm text-emerald-300" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="group relative px-6 py-0.5 pb-1.5 pt-2.5 transition duration-200 ">

                            <div class="flex items-center justify-between">
                                <label for="email"
                                    class="text-xs font-medium text-gray-400 group-focus-within:text-white">Email</label>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="ejemplo@gmail.com" required autofocus autocomplete="username"
                                class="block w-full rounded-lg bg-black" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-white" />

                        <div class="mt-4 group relative px-6 rounded-lg">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="text-xs font-medium text-gray-400 group-focus-within:text-white">Contraseña</label>
                            </div>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" class="block w-full bg-black rounded-lg" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-white" />

                        <div class="mt-4 flex items-center justify-between">
                            <label for="remember_me" class="flex items-center gap-2">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="rounded border-white/30 bg-transparent focus:outline focus:outline-sky-300">
                                <span class="text-xs text-zinc-200">Recordarme</span>
                            </label>

                            @if (Route::has('password.request'))
                            <a class="text-sm font-medium underline" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-end gap-4">
                            <a href="{{ route('register') }}"
                                class="inline-flex h-10 items-center justify-center rounded-xl px-3 text-sm font-medium border border-white/10 text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:text-white">
                                Registrarse
                            </a>
                            <button type="submit"
                                class="inline-flex h-10 items-center justify-center rounded-xl border  border-violet-500/30 bg-violet-500/15 px-4 py-2 text-sm font-semibold text-zin-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-500/10">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
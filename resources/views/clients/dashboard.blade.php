<?php
$user = auth()->user();
$client = $user->client;
$showProfileAlert = in_array(null, [
$client->edad,
$client->peso,
$client->altura,
$client->objetivo,
], true);
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ ('Bienvenido, ') }}{{ $user->client->nombre }} {{ $user->client->apellido }}
        </h2>
    </x-slot>

    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <aside class="rounded-2xl border border-white/10 bg-zinc-950 p-5 lg:col-span-3 xl:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Área cliente</p>
                <h3 class="mt-2 text-lg font-semibold text-white">Tu gimnasio</h3>
                <p class="mt-1 text-sm text-zinc-400">Consulta tus reservas y apunta nuevos entrenos.</p>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('clients.dashboard') }}"
                        class="block rounded-xl border border-violet-500/30 bg-violet-500/15 px-4 py-2.5 text-sm font-medium text-violet-200 transition hover:bg-violet-500/25">
                        Mi dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Mi perfil
                    </a>
                     <a href="{{ route('client.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Mi plan
                    </a>
                    <a href="{{ route('clients.reservas') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Mis reservas
                    </a>
                </div>

                <div
                    class="mt-8 rounded-2xl border border-white/10 bg-gradient-to-br from-violet-500/20 via-purple-500/15 to-fuchsia-500/10 p-4">
                    <p class="text-xs uppercase tracking-wide text-violet-200/80">Estado</p>
                    <p class="mt-2 text-sm text-white">Cuenta activa y operativa</p>
                    <p class="mt-1 text-xs text-zinc-300">{{ $user->email }}</p>
                </div>
            </aside>

            <section class="space-y-6 lg:col-span-9 xl:col-span-10">
                @if ($showProfileAlert)
                <div
                    class="flex flex-col justify-between gap-4 rounded-2xl border border-white/10 bg-zinc-950 p-5 md:flex-row md:items-center">

                    <div>

                        <p class="text-sm font-medium text-white">¡Completa tu perfil!</p>
                        <h1 class="mt-1 text-2xl font-semibold text-white">Te faltan datos personales por rellenar.</h1>
                    </div>
                    <div class="flex flex-col items-stretch gap-2 md:items-end">
                        {{-- <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300">
                            Fecha actual: {{ now()->format('d/m/Y H:i') }}
                        </div> --}}

                        @if ($showProfileAlert)
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center justify-center rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-violet-500">
                            Ir a completar perfil
                        </a>
                        @endif
                    </div>
                </div>
                @endif


                <div
                    class="flex flex-col justify-between gap-4 rounded-2xl border border-white/10 bg-zinc-950 p-5 md:flex-row md:items-center">
                    <div>
                        <p class="text-sm text-zinc-400">Panel personal</p>
                        <h1 class="mt-1 text-2xl font-semibold text-white">Tus reservas y entrenamientos</h1>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300">
                        Fecha actual: {{ now()->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Entrenamientos completados</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $reservas->where('estado', 'asistio')->count() }}</p>
                        <p class="mt-2 text-sm text-violet-300">Histórico completo</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Próximas reservas</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $reservas->where('estado', 'confirmada')->count() }}</p>
                        <p class="mt-2 text-sm text-cyan-300">Pendientes de asistir</p>
                    </article>
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Entrenos disponibles</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $entrenamientos->count() }}</p>
                        <p class="mt-2 text-sm text-emerald-300">Con plazas abiertas</p>
                    </article>
                </div>

                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Relación peso · sesiones completadas</h3>
                            <p class="mt-1 text-sm text-zinc-400">
                                Eje X: número de sesiones completadas · Eje Y: peso registrado (kg).
                            </p>
                            <p class="mt-2 text-xs text-zinc-500">
                                El gráfico parte en la sesión 0 con tu peso actual.
                            </p>
                        </div>

                        <form action="{{ route('clients.peso.registrar') }}" method="POST"
                            class="w-full max-w-md rounded-xl border border-white/10 bg-black/20 p-4">
                            @csrf
                            <p class="text-sm font-medium text-white">Registrar peso tras sesión</p>
                            <p class="mt-1 text-xs text-zinc-400">
                                Sesiones completadas: {{ $sesionesCompletadas }} · Registros pendientes: {{ $registrosPesoPendientes }}
                            </p>

                            <div class="mt-3">
                                <label for="peso" class="mb-1 block text-xs uppercase tracking-wide text-zinc-400">Peso actual (kg)</label>
                                <input id="peso" name="peso" type="number" step="0.01" min="30" max="300"
                                    value="{{ old('peso', $user->client->peso) }}"
                                    class="w-full rounded-lg border border-white/10 bg-zinc-950 px-3 py-2 text-sm text-white focus:border-violet-400 focus:outline-none"
                                    required>
                                @error('peso')
                                    <p class="mt-1 text-xs text-rose-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-violet-500">
                                Guardar peso de sesión
                            </button>
                        </form>
                    </div>

                    <div class="mt-5 h-[360px] rounded-xl border border-white/10 bg-black/20 p-4">
                        <x-chartjs-component :chart="$chart" />
                    </div>
                </article>

                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5 xl:col-span-2">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Mis reservas</h3>
                            <span class="text-sm text-zinc-400">Últimos movimientos</span>
                        </div>

                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full min-w-[680px] text-left text-sm">
                                <thead class="text-zinc-400">
                                    <tr class="border-b border-white/10">
                                        <th class="pb-3 font-medium">Entrenamiento</th>
                                        <th class="pb-3 font-medium">Entrenador</th>
                                        <th class="pb-3 font-medium">Estado</th>
                                        <th class="pb-3 font-medium">Fecha</th>
                                    </tr>
                                </thead>
                                @foreach ($reservas as $reserva)
                                
                                
                                <tbody class="text-zinc-200">
                                    <tr class="border-b border-white/5">
                                        <td class="py-3">{{ $reserva->entrenamiento->nombre }}</td>
                                        <td class="py-3">{{ $reserva->entrenamiento->entrenador->nombre }}</td>
                                        <td class="py-3">
                                            <span
                                                class="rounded-full border border-emerald-500/30 bg-emerald-500/10 px-2.5 py-1 text-xs text-emerald-200">
                                                {{ $reserva->estado }}
                                            </span>
                                        </td>
                                        <td class="py-3">{{ $reserva->fecha_reserva }}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <h3 class="text-lg font-semibold text-white">Resumen rápido</h3>
                        <div class="mt-5 space-y-3 text-sm">
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Nombre</span>
                                <span class="font-medium text-white">{{ $user->name }}</span>
                            </div>
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Objetivo</span>
                                <span class="font-medium text-white">{{ $user->client->objetivo }}</span>
                            </div>
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Edad</span>
                                <span class="font-medium text-white">{{ $user->client->edad }} años</span>
                            </div>
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Altura</span>
                                <span class="font-medium text-white">{{ $user->client->altura }} cm</span>
                            </div>
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Peso</span>
                                <span class="font-medium text-white">{{ $user->client->peso }} kg</span>
                            </div>
                        </div>
                    </article>
                </div>

                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Entrenamientos disponibles</h3>
                        <span class="text-sm text-zinc-400">Reserva en 1 clic</span>
                    </div>


                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($entrenamientos as $entrenamiento)

                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-base font-semibold text-white">{{ $entrenamiento->nombre }}</p>
                            <p class="mt-1 line-clamp-2 text-sm text-zinc-400">{{ $entrenamiento->descripcion }}</p>

                            <div class="mt-3 space-y-1 text-xs text-zinc-400">
                                <p>Entrenador: <span class="text-zinc-200">{{ $entrenamiento->entrenador->nombre }}</span></p>
                                <p>Inicio: <span class="text-zinc-200">{{ $entrenamiento->fecha_inicio }}</span></p>
                                <p>Plazas disponibles: <span class="text-emerald-300">{{ $entrenamiento->capacidad }}</span></p>
                            </div>

                           <form action="{{ route('clients.reservar', ['clientId' => $client->id, 'entrenamientoId' => $entrenamiento->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="mt-4 w-full rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-violet-500">
                                    Reservar
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
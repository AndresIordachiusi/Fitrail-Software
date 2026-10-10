<x-app-layout>
    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <aside class="rounded-2xl border border-white/10 bg-zinc-950 p-5 lg:col-span-3 xl:col-span-2">
                <h3 class="mt-2 text-lg font-semibold text-white">Control central</h3>
                <p class="mt-1 text-sm text-zinc-400">Resumen y accesos rápidos del gimnasio.</p>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('entrenadors.dashboard') }}"
                        class="block rounded-xl border border-violet-500/30 bg-violet-500/15 px-4 py-2.5 text-sm font-medium text-violet-200 transition hover:bg-violet-500/25">
                        Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-500/10">

                        Mi perfil
                    </a>
                    <a href="{{ route('entrenador.entrenamientos.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-500/10">
                        Entrenamientos
                    </a>
                </div>

                <div
                    class="mt-8 rounded-2xl border border-white/10 bg-gradient-to-br from-violet-500/20 via-purple-500/15 to-fuchsia-500/10 p-4">
                    <p class="text-xs uppercase tracking-wide text-violet-200/80">Estado del sistema</p>
                    <p class="mt-2 text-sm text-white">Todos los módulos operativos</p>
                    <p class="mt-1 text-xs text-zinc-300">Última actualización: {{ now()->format('d/m/Y H:i') }}</p>
                </div>
            </aside>
            <section class="space-y-6 lg:col-span-9 xl:col-span-10">
                <div
                    class="flex flex-col justify-between gap-4 rounded-2xl border border-white/10 bg-zinc-950 p-5 md:flex-row md:items-center">
                    <div>
                        <p class="text-sm text-zinc-400">Vista general</p>
                        <h1 class="mt-1 text-2xl font-semibold text-white">Dashboard de gestión</h1>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300">
                        Rango: {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}
                    </div>
                </div>
                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Entrenamientos disponibles</h3>
                        <a href="{{ route('entrenador.entrenamientos.create') }}"
                            class="block rounded-xl border border-violet-500/30 bg-violet-500/15 px-4 py-2.5 text-sm font-medium text-violet-200 transition hover:bg-violet-500/25">
                            Crear entrenamiento
                        </a>
                    </div>


                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($entrenamientos as $entrenamiento)

                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-base font-semibold text-white">{{ $entrenamiento->nombre }}</p>
                            <p class="mt-1 line-clamp-2 text-sm text-zinc-400">{{ $entrenamiento->descripcion }}</p>

                            <div class="mt-3 space-y-1 text-xs text-zinc-400">
                                <p>Entrenador: <span class="text-zinc-200">{{ $entrenamiento->entrenador->nombre
                                        }}</span></p>
                                <p>Inicio: <span class="text-zinc-200">{{ $entrenamiento->fecha_inicio }}</span></p>
                                <p>Plazas disponibles: <span class="text-emerald-300">{{ $entrenamiento->capacidad
                                        }}</span></p>
                            </div>

                            {{-- <button type="button"
                                class="mt-4 w-full rounded-lg bg-violet-600 px-3 py-2 text-sm font-medium text-white hover:bg-violet-500">
                                Reservar entrenamiento
                            </button> --}}
                        </div>
                        @endforeach
                    </div>
                </article>

                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Mis clases</h3>
                        <span class="text-sm text-zinc-400">Reservas confirmadas de tus entrenamientos</span>
                    </div>

                    <div class="mt-4 overflow-x-auto rounded-xl border border-white/10">
                        <table class="w-full min-w-[760px] text-left text-sm">
                            <thead class="bg-white/5 text-zinc-400">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Entrenamiento</th>
                                    <th class="px-4 py-3 font-medium">Cliente</th>
                                    <th class="px-4 py-3 font-medium">Fecha de inicio</th>
                                    <th class="px-4 py-3 font-medium">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="text-zinc-200">
                                @forelse ($misClases as $clase)
                                    <tr class="border-t border-white/5 hover:bg-white/5">
                                        <td class="px-4 py-3 font-medium text-white">{{ $clase->entrenamiento->nombre ?? 'Sin entrenamiento' }}</td>
                                        <td class="px-4 py-3">{{ ($clase->cliente->nombre ?? '') . ' ' . ($clase->cliente->apellido ?? '') }}</td>
                                        <td class="px-4 py-3">{{ $clase->entrenamiento->fecha_inicio ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="rounded-full border border-cyan-500/30 bg-cyan-500/10 px-2.5 py-1 text-xs text-cyan-200">
                                                {{ ucfirst($clase->estado) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-10 text-center text-zinc-500">
                                            Aún no tienes reservas confirmadas en tus clases.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </article>

            </section>

        </div>

    </div>
</x-app-layout>
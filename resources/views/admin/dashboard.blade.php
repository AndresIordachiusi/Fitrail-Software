<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Panel de Administración · Gimnasio Maquinistas
        </h2>
    </x-slot> --}}

    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <aside class="rounded-2xl border border-white/10 bg-zinc-950 p-5 lg:col-span-3 xl:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">Administración</p>
                <h3 class="mt-2 text-lg font-semibold text-white">Control central</h3>
                <p class="mt-1 text-sm text-zinc-400">Resumen y accesos rápidos del gimnasio.</p>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block rounded-xl border border-violet-500/30 bg-violet-500/15 px-4 py-2.5 text-sm font-medium text-violet-200 transition hover:bg-violet-500/25">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Usuarios
                    </a>
                    <a href="{{ route('admin.entrenadors.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Entrenadores
                    </a>
                    <a href="{{ route('admin.entrenamientos.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Entrenamientos
                    </a>
                    <a href="{{ route('admin.reservas.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Reservas
                    </a>
                     <a href="{{ route('admin.seguimientos.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Seguimientos
                    </a>
                    <a href="{{ route('admin.plans.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Planes
                    </a>
                    <a href="{{ route('admin.sedes.index') }}"
                        class="block rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                        Sedes
                    </a>
                </div>

                <div class="mt-8 rounded-2xl border border-white/10 bg-gradient-to-br from-violet-500/20 via-purple-500/15 to-fuchsia-500/10 p-4">
                    <p class="text-xs uppercase tracking-wide text-violet-200/80">Estado del sistema</p>
                    <p class="mt-2 text-sm text-white">Todos los módulos operativos</p>
                    <p class="mt-1 text-xs text-zinc-300">Última actualización: {{ now()->format('d/m/Y H:i') }}</p>
                </div>
            </aside>

            <section class="space-y-6 lg:col-span-9 xl:col-span-10">
                <div class="flex flex-col justify-between gap-4 rounded-2xl border border-white/10 bg-zinc-950 p-5 md:flex-row md:items-center">
                    <div>
                        <p class="text-sm text-zinc-400">Vista general de operaciones</p>
                        <h1 class="mt-1 text-2xl font-semibold text-white">Dashboard de gestión</h1>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-300">
                        Rango: {{ now()->startOfMonth()->format('d M Y') }} - {{ now()->endOfMonth()->format('d M Y') }}
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Clientes activos</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $totalClients }}</p>
                        <p class="mt-2 text-sm text-emerald-300">Comunidad registrada</p>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Entrenadores</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $totalEntrenadores }}</p>
                        <p class="mt-2 text-sm text-violet-300">Equipo técnico</p>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Reservas hoy</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $reservasHoy }}</p>
                        <p class="mt-2 text-sm text-cyan-300">Actividad diaria</p>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <p class="text-xs uppercase tracking-wide text-zinc-400">Sedes</p>
                        <p class="mt-3 text-3xl font-semibold text-white">{{ $totalSedes }}</p>
                        <p class="mt-2 text-sm text-fuchsia-300">Cobertura física</p>
                    </article>
                </div>

                <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5 xl:col-span-2">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Últimas reservas</h3>
                            <a href="{{ route('admin.reservas.index') }}" class="text-sm text-violet-300 hover:text-violet-200">Ver todo</a>
                        </div>

                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full min-w-[620px] text-left text-sm">
                                <thead class="text-zinc-400">
                                    <tr class="border-b border-white/10">
                                        <th class="pb-3 font-medium">Cliente</th>
                                        <th class="pb-3 font-medium">Entrenamiento</th>
                                        <th class="pb-3 font-medium">Estado</th>
                                        <th class="pb-3 font-medium">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="text-zinc-200">
                                    @forelse ($ultimasReservas as $reserva)
                                        <tr class="border-b border-white/5">
                                            <td class="py-3">{{ $reserva->cliente->nombre ?? 'Sin cliente' }}</td>
                                            <td class="py-3">{{ $reserva->entrenamiento->nombre ?? 'Sin entrenamiento' }}</td>
                                            <td class="py-3">
                                                <span class="rounded-full border border-violet-400/30 bg-violet-500/10 px-2.5 py-1 text-xs text-violet-200">
                                                    {{ ucfirst(str_replace('_', ' ', $reserva->estado)) }}
                                                </span>
                                            </td>
                                            <td class="py-3">{{ \Illuminate\Support\Carbon::parse($reserva->fecha_reserva)->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-6 text-center text-zinc-500">Todavía no hay reservas registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <h3 class="text-lg font-semibold text-white">Información general</h3>

                        <div class="mt-5 flex items-center gap-4">
                            <div>
                                <p class="text-sm text-zinc-400">Reservas totales</p>
                                <p class="text-2xl font-semibold text-white">{{ $totalReservas }}</p>
                                <p class="text-xs text-zinc-500">Base para medir ocupación</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3 text-sm">
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Entrenamientos</span>
                                <span class="font-medium text-white">{{ $totalEntrenamientos }}</span>
                            </div>
                            <div class="flex items-center justify-between text-zinc-300">
                                <span>Planes creados</span>
                                <span class="font-medium text-white">{{ $totalPlanes }}</span>
                            </div>
                        
                        </div>
                    </article>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Próximos entrenamientos</h3>
                            <a href="{{ route('admin.entrenamientos.index') }}" class="text-sm text-violet-300 hover:text-violet-200">Gestionar</a>
                        </div>

                        <div class="mt-4 space-y-3">
                            @forelse ($proximosEntrenamientos as $entrenamiento)
                                <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                                    <p class="font-medium text-white">{{ $entrenamiento->nombre }}</p>
                                    <p class="mt-1 text-xs text-zinc-400">
                                        {{ \Illuminate\Support\Carbon::parse($entrenamiento->fecha_inicio)->format('d/m/Y H:i') }} ·
                                        {{ $entrenamiento->entrenador->nombre ?? 'Sin entrenador' }}
                                    </p>
                                </div>
                            @empty
                                <p class="rounded-xl border border-white/10 bg-white/5 p-3 text-sm text-zinc-500">No hay entrenamientos próximos.</p>
                            @endforelse
                        </div>
                    </article>

                    <article class="rounded-2xl border border-white/10 bg-zinc-900 p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Planes más populares</h3>
                            <a href="{{ route('admin.plans.index') }}" class="text-sm text-violet-300 hover:text-violet-200">Ver planes</a>
                        </div>

                        <div class="mt-4 space-y-3">
                            @forelse ($planesPopulares as $plan)
                                @php
                                    $porcentaje = $totalClients > 0 ? min(100, round(($plan->clients_count / $totalClients) * 100)) : 0;
                                @endphp
                                <div>
                                    <div class="mb-1 flex items-center justify-between text-sm">
                                        <span class="text-zinc-200">{{ $plan->nombre }}</span>
                                        <span class="text-zinc-400">{{ $plan->clients_count }} clientes</span>
                                    </div>
                                    <div class="h-2 rounded-full bg-zinc-800">
                                        <div class="h-2 rounded-full bg-gradient-to-r from-violet-500 to-fuchsia-500" style="width: {{ $porcentaje }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="rounded-xl border border-white/10 bg-white/5 p-3 text-sm text-zinc-500">Sin datos de popularidad todavía.</p>
                            @endforelse
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
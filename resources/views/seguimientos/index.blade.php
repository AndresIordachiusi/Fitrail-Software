<x-app-layout>
    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-violet-400/30 bg-violet-500/10 px-4 py-3 text-sm text-violet-200">
                {{ session('status') }}
            </div>
        @endif

        <section class="space-y-6 rounded-2xl border border-white/10 bg-zinc-950 p-5">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm text-zinc-400">Panel admin · Seguimiento de progreso</p>
                    <h1 class="mt-1 text-2xl font-semibold text-white">Seguimientos de clientes</h1>
                </div>
                <a href="{{ route('admin.seguimientos.create') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-violet-500/30 bg-violet-500/15 px-3 py-1.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-600/10">
                    + Nuevo seguimiento
                </a>
            </div>

            <form method="GET" action="{{ route('admin.seguimientos.index') }}"
                class="grid grid-cols-1 gap-3 rounded-xl border border-white/10 bg-black/30 p-4 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label for="client_id" class="mb-1 block text-xs uppercase tracking-wide text-zinc-400">Cliente</label>
                    <select id="client_id" name="client_id"
                        class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white focus:border-violet-400 focus:outline-none">
                        <option value="">Todos los clientes</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ (string) ($filters['client_id'] ?? '') === (string) $client->id ? 'selected' : '' }}>
                                {{ $client->nombre }} {{ $client->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="progreso" class="mb-1 block text-xs uppercase tracking-wide text-zinc-400">Progreso</label>
                    <select id="progreso" name="progreso"
                        class="w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-sm text-white focus:border-violet-400 focus:outline-none">
                        <option value="">Todos</option>
                        <option value="mejorando" {{ ($filters['progreso'] ?? '') === 'mejorando' ? 'selected' : '' }}>Mejorando</option>
                        <option value="sin_cambios" {{ ($filters['progreso'] ?? '') === 'sin_cambios' ? 'selected' : '' }}>Sin cambios</option>
                        <option value="retroceso" {{ ($filters['progreso'] ?? '') === 'retroceso' ? 'selected' : '' }}>Retroceso</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white hover:bg-violet-500">Filtrar</button>
                    <a href="{{ route('admin.seguimientos.index') }}"
                        class="rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-sm text-zinc-200 hover:bg-white/10">Limpiar</a>
                </div>
            </form>

            <div class="overflow-x-auto rounded-xl border border-white/10">
                <table class="w-full min-w-[1100px] text-left text-sm">
                    <thead class="bg-white/5 text-zinc-400">
                        <tr>
                            <th class="px-4 py-3 font-medium">Fecha</th>
                            <th class="px-4 py-3 font-medium">Cliente</th>
                            <th class="px-4 py-3 font-medium">Entrenador</th>
                            <th class="px-4 py-3 font-medium">Peso</th>
                            <th class="px-4 py-3 font-medium">IMC</th>
                            <th class="px-4 py-3 font-medium">Energía</th>
                            <th class="px-4 py-3 font-medium">Adherencia</th>
                            <th class="px-4 py-3 font-medium">Progreso</th>
                            <th class="px-4 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @forelse ($seguimientos as $seguimiento)
                            <tr class="border-t border-white/5 hover:bg-white/5">
                                <td class="px-4 py-3">{{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 font-medium text-white">{{ $seguimiento->client->nombre }}
                                    {{ $seguimiento->client->apellido }}</td>
                                <td class="px-4 py-3">{{ $seguimiento->entrenador?->nombre ?? '—' }}
                                    {{ $seguimiento->entrenador?->apellido }}</td>
                                <td class="px-4 py-3">{{ $seguimiento->peso ? $seguimiento->peso . ' kg' : '—' }}</td>
                                <td class="px-4 py-3">{{ $seguimiento->imc ?? '—' }}</td>
                                <td class="px-4 py-3">{{ $seguimiento->nivel_energia }}/5</td>
                                <td class="px-4 py-3">{{ $seguimiento->adherencia }}/5</td>
                                <td class="px-4 py-3">
                                    @if ($seguimiento->progreso === 'mejorando')
                                        <span
                                            class="rounded-full border border-emerald-500/30 bg-emerald-500/10 px-2 py-1 text-xs text-emerald-200">Mejorando</span>
                                    @elseif ($seguimiento->progreso === 'retroceso')
                                        <span
                                            class="rounded-full border border-rose-500/30 bg-rose-500/10 px-2 py-1 text-xs text-rose-200">Retroceso</span>
                                    @else
                                        <span
                                            class="rounded-full border border-zinc-500/30 bg-zinc-500/10 px-2 py-1 text-xs text-zinc-200">Sin cambios</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.seguimientos.show', $seguimiento) }}"
                                            class="rounded-lg border border-white/20 bg-white/5 px-3 py-1.5 text-xs font-medium text-zinc-200 hover:bg-white/10">Ver</a>
                                        <a href="{{ route('admin.seguimientos.edit', $seguimiento) }}"
                                            class="rounded-lg border border-cyan-500/30 bg-cyan-500/10 px-3 py-1.5 text-xs font-medium text-cyan-200 hover:bg-cyan-500/20">Editar</a>
                                        <form method="POST" action="{{ route('admin.seguimientos.destroy', $seguimiento) }}"
                                            onsubmit="return confirm('¿Eliminar este seguimiento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg border border-rose-500/30 bg-rose-500/10 px-3 py-1.5 text-xs font-medium text-rose-200 hover:bg-rose-500/20">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-10 text-center text-zinc-500">No hay seguimientos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $seguimientos->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

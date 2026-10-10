<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">Administración de sedes</h2>
    </x-slot>

    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-violet-400/30 bg-violet-500/10 px-4 py-3 text-sm text-violet-200">
                {{ session('status') }}
            </div>
        @endif

        <section class="space-y-6 rounded-2xl border border-white/10 bg-zinc-950 p-5">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm text-zinc-400">Panel admin · Gestión CRUD</p>
                    <h1 class="mt-1 text-2xl font-semibold text-white">Listado de sedes</h1>
                </div>
                <a href="{{ route('admin.sedes.create') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-violet-500/30 bg-violet-500/15 px-3 py-1.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-600/10">
                    + Nueva sede
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-white/10">
                <table class="w-full min-w-[980px] text-left text-sm">
                    <thead class="bg-white/5 text-zinc-400">
                        <tr>
                            <th class="px-4 py-3 font-medium">ID</th>
                            <th class="px-4 py-3 font-medium">Dirección</th>
                            <th class="px-4 py-3 font-medium">Teléfono</th>
                            <th class="px-4 py-3 font-medium">Ciudad</th>
                            <th class="px-4 py-3 font-medium">Apertura</th>
                            <th class="px-4 py-3 font-medium">Cierre</th>
                            <th class="px-4 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @forelse ($sedes as $sede)
                            <tr class="border-t border-white/5 hover:bg-white/5">
                                <td class="px-4 py-3">{{ $sede->id }}</td>
                                <td class="px-4 py-3 font-medium text-white">{{ $sede->direccion }}</td>
                                <td class="px-4 py-3">{{ $sede->telefono }}</td>
                                <td class="px-4 py-3">{{ $sede->ciudad }}</td>
                                <td class="px-4 py-3">{{ $sede->horario_apertura }}</td>
                                <td class="px-4 py-3">{{ $sede->horario_cierre }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.sedes.edit', $sede) }}"
                                            class="rounded-lg border border-cyan-500/30 bg-cyan-500/10 px-3 py-1.5 text-xs font-medium text-cyan-200 transition hover:bg-cyan-500/20">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.sedes.destroy', $sede) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta sede?');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="rounded-lg border border-rose-500/30 bg-rose-500/10 px-3 py-1.5 text-xs font-medium text-rose-200 transition hover:bg-rose-500/20">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-zinc-500">No hay sedes registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>
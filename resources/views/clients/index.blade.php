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
                    <p class="text-sm text-zinc-400">Panel admin · Gestión CRUD</p>
                    <h1 class="mt-1 text-2xl font-semibold text-white">Listado de clientes</h1>
                </div>
                <a href="{{ route('clients.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-violet-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-violet-500">
                    + Nuevo cliente
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-white/10">
                <table class="w-full min-w-[980px] text-left text-sm">
                    <thead class="bg-white/5 text-zinc-400">
                        <tr>
                            <th class="px-4 py-3 font-medium">ID</th>
                            <th class="px-4 py-3 font-medium">Nombre</th>
                            <th class="px-4 py-3 font-medium">Email</th>
                            <th class="px-4 py-3 font-medium">Edad</th>
                            <th class="px-4 py-3 font-medium">Altura</th>
                            <th class="px-4 py-3 font-medium">Peso</th>
                            <th class="px-4 py-3 font-medium">Objetivo</th>
                            <th class="px-4 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @forelse ($clients as $client)
                            <tr class="border-t border-white/5 hover:bg-white/5">
                                <td class="px-4 py-3">{{ $client->id }}</td>
                                <td class="px-4 py-3 font-medium text-white">{{ $client->nombre }}</td>
                                <td class="px-4 py-3">{{ $client->email }}</td>
                                <td class="px-4 py-3">{{ $client->edad }}</td>
                                <td class="px-4 py-3">{{ $client->altura }}</td>
                                <td class="px-4 py-3">{{ $client->peso }}</td>
                                <td class="px-4 py-3">{{ $client->objetivo }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                            class="rounded-lg border border-cyan-500/30 bg-cyan-500/10 px-3 py-1.5 text-xs font-medium text-cyan-200 transition hover:bg-cyan-500/20">
                                            Editar
                                        </a>
                                        <button type="button"
                                            onclick="openDeleteModal({{ $client->id }}, '{{ $client->nombre }}')"
                                            class="rounded-lg border border-rose-500/30 bg-rose-500/10 px-3 py-1.5 text-xs font-medium text-rose-200 transition hover:bg-rose-500/20">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-zinc-500">No hay clientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4">
        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-zinc-900 p-6 shadow-xl">
            <h3 class="text-lg font-semibold text-white">¿Confirmar eliminación?</h3>
            <p class="mt-2 text-sm text-zinc-300">Se eliminará el cliente <strong id="clientName" class="text-white"></strong>.</p>

            <div class="mt-6 flex items-center justify-end gap-2">
                <button type="button" onclick="closeDeleteModal()"
                    class="rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-lg border border-rose-500/30 bg-rose-500/20 px-3 py-2 text-sm font-medium text-rose-100 hover:bg-rose-500/30">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(clientId, clientName) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const clientNameEl = document.getElementById('clientName');

            clientNameEl.textContent = clientName;
            deleteForm.action = "{{ route('clients.destroy', ':id') }}".replace(':id', clientId);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
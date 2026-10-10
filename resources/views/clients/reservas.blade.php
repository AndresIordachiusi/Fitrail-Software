<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">Mis reservas</h2>
    </x-slot>

    <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                {{ session('error') }}
            </div>
        @endif

        <section class="space-y-6 rounded-2xl border border-white/10 bg-zinc-950 p-5">
            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm text-zinc-400">Panel cliente</p>
                    <h1 class="text-2xl font-semibold text-white">Historial de reservas</h1>
                </div>
                <a href="{{ route('clients.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-sm text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                    Volver al dashboard
                </a>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('clients.reservas') }}"
                    class="rounded-lg border px-3 py-1.5 text-xs font-medium transition {{ ($estado ?? 'todas') === 'todas' ? 'border-violet-500/40 bg-violet-500/15 text-violet-200' : 'border-white/10 bg-white/5 text-zinc-300 hover:border-violet-400/40 hover:bg-violet-500/10' }}">
                    Todas
                </a>
                <a href="{{ route('clients.reservas', ['estado' => 'confirmada']) }}"
                    class="rounded-lg border px-3 py-1.5 text-xs font-medium transition {{ ($estado ?? 'todas') === 'confirmada' ? 'border-cyan-500/40 bg-cyan-500/15 text-cyan-200' : 'border-white/10 bg-white/5 text-zinc-300 hover:border-cyan-400/40 hover:bg-cyan-500/10' }}">
                    Confirmadas
                </a>
                <a href="{{ route('clients.reservas', ['estado' => 'cancelada']) }}"
                    class="rounded-lg border px-3 py-1.5 text-xs font-medium transition {{ ($estado ?? 'todas') === 'cancelada' ? 'border-rose-500/40 bg-rose-500/15 text-rose-200' : 'border-white/10 bg-white/5 text-zinc-300 hover:border-rose-400/40 hover:bg-rose-500/10' }}">
                    Canceladas
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-white/10">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="bg-white/5 text-zinc-400">
                        <tr>
                            <th class="px-4 py-3 font-medium">Entrenamiento</th>
                            <th class="px-4 py-3 font-medium">Entrenador</th>
                            <th class="px-4 py-3 font-medium">Fecha reserva</th>
                            <th class="px-4 py-3 font-medium">Estado</th>
                            <th class="px-4 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @forelse ($reservas as $reserva)
                            <tr class="border-t border-white/5 hover:bg-white/5">
                                <td class="px-4 py-3 font-medium text-white">{{ $reserva->entrenamiento->nombre ?? 'Sin entrenamiento' }}</td>
                                <td class="px-4 py-3">{{ $reserva->entrenamiento->entrenador->nombre ?? 'Sin entrenador' }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reserva->fecha_reserva)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusClass = match($reserva->estado) {
                                            'confirmada' => 'border-cyan-500/30 bg-cyan-500/10 text-cyan-200',
                                            'cancelada' => 'border-rose-500/30 bg-rose-500/10 text-rose-200',
                                            'asistio' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-200',
                                            default => 'border-zinc-500/30 bg-zinc-500/10 text-zinc-200',
                                        };
                                    @endphp
                                    <span class="rounded-full border px-2.5 py-1 text-xs {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $reserva->estado)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($reserva->estado === 'confirmada')
                                        <button type="button"
                                            data-id="{{ $reserva->id }}"
                                            data-entrenamiento="{{ $reserva->entrenamiento->nombre ?? 'este entrenamiento' }}"
                                            class="btn-cancelar rounded-lg border border-rose-500/30 bg-rose-500/10 px-3 py-1.5 text-xs font-medium text-rose-200 transition hover:bg-rose-500/20">
                                            Cancelar reserva
                                        </button>
                                    @else
                                        <span class="text-xs text-zinc-500">Sin acciones</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-zinc-500">No tienes reservas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4">
        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-zinc-900 p-6 shadow-xl">
            <h3 class="text-lg font-semibold text-white">¿Cancelar reserva?</h3>
            <p class="mt-2 text-sm text-zinc-300">
                Esta acción cancelará tu reserva para <strong id="reservaEntrenamiento" class="text-white"></strong>.
            </p>

            <div class="mt-6 flex items-center justify-end gap-2">
                <button type="button" onclick="closeCancelModal()"
                    class="rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">
                    Volver
                </button>
                <form id="cancelForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="rounded-lg border border-rose-500/30 bg-rose-500/20 px-3 py-2 text-sm font-medium text-rose-100 hover:bg-rose-500/30">
                        Sí, cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-cancelar').forEach((button) => {
                button.addEventListener('click', () => {
                    openCancelModal(button.dataset.id, button.dataset.entrenamiento);
                });
            });
        });

        function openCancelModal(reservaId, entrenamientoNombre) {
            const modal = document.getElementById('cancelModal');
            const cancelForm = document.getElementById('cancelForm');
            const entrenamientoEl = document.getElementById('reservaEntrenamiento');

            entrenamientoEl.textContent = entrenamientoNombre;
            cancelForm.action = "{{ route('clients.reservas.cancelar', ':id') }}".replace(':id', reservaId);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
<x-app-layout>
    <div class="mx-auto w-full max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
        <section class="space-y-6 rounded-2xl border border-white/10 bg-zinc-950 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-zinc-400">Detalle de seguimiento</p>
                    <h1 class="mt-1 text-2xl font-semibold text-white">{{ $seguimiento->client->nombre }} {{ $seguimiento->client->apellido }}</h1>
                </div>
                <a href="{{ route('admin.seguimientos.index') }}"
                    class="rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-sm text-zinc-200 hover:bg-white/10">
                    Volver
                </a>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Fecha</p>
                    <p class="mt-1 text-lg font-semibold text-white">{{ $seguimiento->fecha_seguimiento->format('d/m/Y') }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Entrenador</p>
                    <p class="mt-1 text-lg font-semibold text-white">{{ $seguimiento->entrenador?->nombre ?? 'Sin asignar' }} {{ $seguimiento->entrenador?->apellido }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Progreso</p>
                    <p class="mt-1 text-lg font-semibold text-white">{{ str_replace('_', ' ', ucfirst($seguimiento->progreso)) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Peso</p>
                    <p class="mt-1 text-base font-medium text-white">{{ $seguimiento->peso ? $seguimiento->peso . ' kg' : '—' }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Altura</p>
                    <p class="mt-1 text-base font-medium text-white">{{ $seguimiento->altura ? $seguimiento->altura . ' m' : '—' }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">IMC</p>
                    <p class="mt-1 text-base font-medium text-white">{{ $seguimiento->imc ?? '—' }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Energía / Adherencia</p>
                    <p class="mt-1 text-base font-medium text-white">{{ $seguimiento->nivel_energia }}/5 · {{ $seguimiento->adherencia }}/5</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Observaciones</p>
                    <p class="mt-2 whitespace-pre-line text-sm text-zinc-200">{{ $seguimiento->observaciones ?: 'Sin observaciones.' }}</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-black/30 p-4">
                    <p class="text-xs uppercase tracking-wide text-zinc-400">Próximos pasos</p>
                    <p class="mt-2 whitespace-pre-line text-sm text-zinc-200">{{ $seguimiento->proximos_pasos ?: 'Sin próximos pasos definidos.' }}</p>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

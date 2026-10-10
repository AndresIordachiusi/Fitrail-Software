<x-guest-layout>


    <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="w-full max-w-2xl mx-auto mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full flex items-center justify-center text-sm font-bold
                  bg-violet-500 text-white">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#fff"
                                    d="m9.55 15.15l8.475-8.475q.3-.3.7-.3t.7.3t.3.713t-.3.712l-9.175 9.2q-.3.3-.7.3t-.7-.3L4.55 13q-.3-.3-.288-.712t.313-.713t.713-.3t.712.3z" />
                            </svg></span>
                    </div>
                    <span class="text-sm font-semibold text-violet-300">Tu información</span>
                </div>

                <div class="flex-1 h-1 mx-4 rounded bg-violet-500/60"></div>

                <div class="flex items-center gap-3">
                    <div
                        class="h-12 w-12 rounded-full flex items-center justify-center text-sm font-bold rounded border border-white/80 bg-white/5">

                        <div class="h-9 w-9 rounded-full flex items-center justify-center text-sm font-bold
                  bg-violet-500 text-white">
                            <span>2</span>
                        </div>

                    </div>
                    <span class="text-sm font-semibold text-violet-300">Membresía</span>
                </div>
            </div>
        </div>

        <section id="planes" class="space-y-6">
            <div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
                <div>
                    <p class="text-sm text-violet-300">Membresías</p>
                    <h2 class="text-3xl font-semibold text-white">Planes para cada objetivo</h2>
                </div>
                <p class="max-w-xl text-sm text-zinc-400">Precios y beneficios oficiales con cualquier plan</p>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-6">
                    <h3 class="text-lg font-semibold text-white">{{ $planes[0]->nombre }}</h3>
                    <p class="mt-1 text-sm text-zinc-400">{{ $planes[0]->descripcion }}</p>
                    <p class="mt-4 text-3xl font-semibold text-white">{{ $planes[0]->precio }} €<span
                            class="text-sm text-zinc-400">/mes</span></p>
                    <ul class="mt-5 space-y-2 text-sm text-zinc-300">
                        <li>• Acceso en horario estándar</li>
                        <li>• 2 clases grupales por semana</li>
                        <li>• Evaluación inicial</li>
                    </ul>
                    <form action="{{ route('checkout', $planes[0]->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="mt-6 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white transition hover:border-violet-400/40 hover:bg-violet-500/10">Seleccionar</button>
                    </form>
                </article>

                <article
                    class="rounded-2xl border border-violet-400/40 bg-gradient-to-b from-violet-500/20 to-zinc-900 p-6 shadow-[0_0_40px_rgba(139,92,246,0.25)]">
                    <p
                        class="w-fit rounded-full border border-violet-300/40 bg-violet-500/20 px-2.5 py-1 text-xs text-violet-100">
                        Más popular</p>
                    <h3 class="mt-3 text-lg font-semibold text-white">{{ $planes[1]->nombre }}</h3>
                    <p class="mt-1 text-sm text-zinc-300">{{ $planes[1]->descripcion }}</p>
                    <p class="mt-4 text-3xl font-semibold text-white">{{ $planes[1]->precio }} €<span
                            class="text-sm text-zinc-300">/mes</span></p>
                    <ul class="mt-5 space-y-2 text-sm text-zinc-200">
                        <li>• Acceso total al gimnasio</li>
                        <li>• Clases ilimitadas</li>
                        <li>• Rutina personalizada mensual</li>
                    </ul>
                    <form action="{{ route('checkout', $planes[1]->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="mt-6 w-full rounded-xl border border-violet-400/40 bg-violet-500/20 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-violet-500/30">Elegir
                            Pro</button>
                    </form>
                </article>

                <article class="rounded-2xl border border-white/10 bg-zinc-900 p-6">
                    <h3 class="text-lg font-semibold text-white">{{ $planes[2]->nombre }}</h3>
                    <p class="mt-1 text-sm text-zinc-400">{{ $planes[2]->descripcion }}</p>
                    <p class="mt-4 text-3xl font-semibold text-white">{{ $planes[2]->precio }} €<span
                            class="text-sm text-zinc-400">/mes</span></p>
                    <ul class="mt-5 space-y-2 text-sm text-zinc-300">
                        <li>• Entrenador personal 1:1</li>
                        <li>• Nutrición y seguimiento semanal</li>
                        <li>• Zona recovery incluida</li>
                    </ul>
                    <form action="{{ route('checkout', $planes[2]->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="mt-6 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white transition hover:border-violet-400/40 hover:bg-violet-500/10">Seleccionar</button>
                    </form>

                </article>
            </div>
        </section>


    </div>

    {{-- <form action="{{ route('checkout', $plan->id) }}" method="POST">
        @csrf
        <button type="submit"
            class="mt-7 w-full rounded-xl bg-rose-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-rose-400">Comprar</button>
    </form> --}}
</x-guest-layout>
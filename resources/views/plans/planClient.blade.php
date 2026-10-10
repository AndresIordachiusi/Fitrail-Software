<x-app-layout>


    <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <?php
        $planActivo = auth()->user()->client->plans()
        ->wherePivot('estado', 'Activo')
        ->latest('client_plan.fecha_inicio')
        ->first();
        $planDesactivado = auth()->user()->client->plans()
        ->wherePivot('estado', 'Desactivado')
        ->latest('client_plan.fecha_inicio')
        ->first();
        ?>

        @if($planActivo)

        {{-- <p class="text-sm font-medium">¡Tienes una suscripción activa! Disfruta de tus beneficios.</p>
        <h2 class="text-xl font-bold text-black-800">Plan: {{ auth()->user()->client->plans()->first()->nombre }}
        </h2>
        {{-- <h2 class="text-lg font-semibold text-black-800">estado: {{
            auth()->user()->client->plans()->first()->plan()->estado }}</h2> --}}
        {{-- <h2 class="text-xl font-semibold text-black-800">Plan: {{
            auth()->user()->client->plans()->first()->descripcion }}</h2> --}}

        <section id="gestionar-plan" class="space-y-10">
            <div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
                <div>
                    <h2 class="text-4xl font-semibold text-white">Gestiona tu plan</h2>
                </div>
            </div>


            <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-zinc-950">
                <div class="pointer-events-none absolute inset-0">
                    <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-violet-500/25 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-12 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
                </div>

                <div class="relative grid grid-cols-1 gap-8 p-8 lg:grid-cols-2 lg:p-12">
                    <div class="flex flex-col justify-center">
                        {{-- <span
                            class="w-fit rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1 text-xs font-medium uppercase tracking-widest text-violet-200">
                            Nuevo ciclo fitness 2026
                        </span> --}}

                        <h1 class="mt-5 text-4xl font-semibold leading-tight text-white sm:text-5xl">
                            Suscripción activa: {{ $planActivo->nombre }}
                        </h1>

                        <div class="flex items-center gap-5">

                            <p class=" flex-item mt-4 max-w-xl text-sm text-white font-semibold ">
                                Tu suscripción: {{ $planActivo->precio }} €/mes - {{
                                $planActivo->pivot->estado }}

                            </p>
                            <p class=" flex-item mt-4 max-w-xl text-sm text-white font-semibold ">
                                Fecha de caducidad: {{ $planActivo->pivot->fecha_fin }}

                            </p>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <a href="#planes"
                                class="rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
                                Ver planes
                            </a>
                            {{-- <a href="#clases"
                                class="rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 text-sm font-medium text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
                                Explorar clases
                            </a> --}}
                        </div>

                        {{-- <div class="mt-8 grid grid-cols-3 gap-3 text-center">
                            <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                <p class="text-2xl font-semibold text-white">+4k</p>
                                <p class="text-xs text-zinc-400">Miembros</p>
                            </div>
                            <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                <p class="text-2xl font-semibold text-white">85%</p>
                                <p class="text-xs text-zinc-400">Retención</p>
                            </div>
                            <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                <p class="text-2xl font-semibold text-white">24/7</p>
                                <p class="text-xs text-zinc-400">Acceso</p>
                            </div>
                        </div> --}}
                    </div>

                    {{-- <div class="overflow-hidden rounded-2xl border border-white/10 bg-zinc-900">
                        @if($entry && $entry->getBienvenida())
                        <img src="https:{{ $entry->getBienvenida()->getFile()->getUrl() }}" alt="Imagen">
                        @endif
                    </div> --}}
                </div>
            </section>

            <section id="planes" class="space-y-6">
                <div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
                    <div>
                        <p class="text-sm text-violet-300">Membresías</p>
                        <h2 class="text-3xl font-semibold text-white">Actualiza tu plan en cualquier momento</h2>
                    </div>
                    <p class="max-w-xl text-sm text-zinc-400">Hazte con un plan que se adapte a tus necesidades y objetivos.</p>
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

            @elseif($planDesactivado)


            <section id="gestionar-plan" class="space-y-10">
                <div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
                    <div>
                        <h2 class="text-4xl font-semibold text-white">Gestiona tu plan</h2>
                    </div>
                </div>

                <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-zinc-950">
                    <div class="pointer-events-none absolute inset-0">
                        <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-violet-500/25 blur-3xl"></div>
                        <div class="absolute -bottom-24 -right-12 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl">
                        </div>
                    </div>

                    <div class="relative grid grid-cols-1 gap-8 p-8 lg:grid-cols-2 lg:p-12">
                        <div class="flex flex-col justify-center">
                            {{-- <span
                                class="w-fit rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1 text-xs font-medium uppercase tracking-widest text-violet-200">
                                Nuevo ciclo fitness 2026
                            </span> --}}

                            <h1 class="mt-5 text-4xl font-semibold leading-tight text-white sm:text-5xl">
                                Tu plan esta inactivo
                            </h1>

                            <div class="flex items-center  gap-5 ">

                                <p class=" flex-item mt-4 max-w-xl text-sm text-white font-semibold ">
                                    Tu ultimo plan: {{ $planDesactivado->nombre }} {{
                                    $planDesactivado->precio }} €/mes - {{
                                    $planDesactivado->pivot->estado }}

                                </p>
                                <p class=" flex-item mt-4 max-w-xl text-sm text-white font-semibold ">
                                    Fecha de caducidad: {{ $planDesactivado->pivot->fecha_fin }}

                                </p>

                            </div>

                            <p class=" flex-item mt-4 max-w-xl text-sm text-white font-semibold ">
                                Si quieres seguir usando nuestros servicios, renueva tu plan.
                            </p>
                            <div class="mt-8 flex flex-wrap items-center gap-3">
                                <a href="#planes"
                                    class="rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
                                    Ver planes
                                </a>

                            </div>

                            {{-- <div class="mt-8 grid grid-cols-3 gap-3 text-center">
                                <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                    <p class="text-2xl font-semibold text-white">+4k</p>
                                    <p class="text-xs text-zinc-400">Miembros</p>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                    <p class="text-2xl font-semibold text-white">85%</p>
                                    <p class="text-xs text-zinc-400">Retención</p>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3">
                                    <p class="text-2xl font-semibold text-white">24/7</p>
                                    <p class="text-xs text-zinc-400">Acceso</p>
                                </div>
                            </div> --}}
                        </div>

                        {{-- <div class="overflow-hidden rounded-2xl border border-white/10 bg-zinc-900">
                            @if($entry && $entry->getBienvenida())
                            <img src="https:{{ $entry->getBienvenida()->getFile()->getUrl() }}" alt="Imagen">
                            @endif
                        </div> --}}
                    </div>
                </section>

                <section id="planes" class="space-y-6">
                    <div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
                        <div>
                            <p class="text-sm text-violet-300">Membresías</p>
                            <h2 class="text-3xl font-semibold text-white">Planes para cada objetivo</h2>
                        </div>
                        <p class="max-w-xl text-sm text-zinc-400">Precios y beneficios de ejemplo para mostrar la
                            estructura
                            de
                            una sección comercial.</p>
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
                @endif


    </div>

    {{-- <form action="{{ route('checkout', $plan->id) }}" method="POST">
        @csrf
        <button type="submit"
            class="mt-7 w-full rounded-xl bg-rose-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-rose-400">Comprar</button>
    </form> --}}
</x-app-layout>
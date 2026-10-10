<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/10 bg-black/95 backdrop-blur">
    <div class="mx-auto flex h-16 w-full max-w-[1600px] items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">

            <span class="text-2xl font-semibold tracking-wide text-white">G-Fitrail</span>

            <div class="hidden items-center gap-2 md:flex">
                @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Panel Administrador
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.users.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Usuarios
                </a>
                <a href="{{ route('admin.entrenadors.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.entrenadors.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Entrenadores
                </a>
                <a href="{{ route('admin.entrenamientos.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.entrenamientos.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Entrenamientos
                </a>
                <a href="{{ route('admin.reservas.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.reservas.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Reservas
                </a>
                <a href="{{ route('admin.seguimientos.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.seguimientos.*') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Seguimientos
                </a>
                <a href="{{ route('admin.plans.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.plans.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Planes
                </a>
                <a href="{{ route('admin.sedes.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('admin.sedes.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Sedes
                </a>

                @elseif (auth()->user()->role === 'client')
                <a href="{{ route('clients.dashboard') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('clients.dashboard') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Mi panel
                </a>
                @elseif (auth()->user()->role === 'entrenador')
                <a href="{{ route('entrenadors.dashboard') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('entrenadors.dashboard') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Panel entrenador
                </a>
                {{-- Usamo Routeis para verificar que ruta y ? para seguir el comportamiento si es o no --}}
                <a href="{{ route('entrenador.entrenamientos.index') }}"
                    class="rounded-lg px-3 py-1.5 text-sm {{ request()->routeIs('entrenador.entrenamientos.index') ? 'bg-violet-500/20 text-violet-200' : 'text-zinc-300 hover:bg-white/10 hover:text-white' }}">
                    Entrenamientoss
                </a>
                @endif
            </div>
        </div>

        <div class="hidden items-center gap-3 md:flex">
            <a href="{{ route('profile.edit') }}"
                class="rounded-lg border border-violet-500/30 bg-violet-500/15 px-3 py-1.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-600/10">
                Perfil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-lg border border-violet-500/30 bg-violet-500/15 px-3 py-1.5 text-sm text-zinc-200 transition duration-300 hover:border-violet-400/40 hover:bg-violet-600/10">
                    Cerrar sesión
                </button>
            </form>
        </div>

        <button @click="open = !open" class="rounded-lg p-2 text-zinc-300 hover:bg-white/10 md:hidden">
            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-cloak :class="open ? 'block' : 'hidden'" class="border-t border-white/10 bg-black/95 md:hidden">
        <div class="space-y-1 px-4 py-3">
            @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Dashboard</a>
            <a href="{{ route('admin.users.index') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Usuarios</a>
            <a href="{{ route('admin.entrenamientos.index') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Entrenamientos</a>
            <a href="{{ route('admin.reservas.index') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Reservas</a>
            <a href="{{ route('admin.seguimientos.index') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Seguimientos</a>
            @elseif (auth()->user()->role === 'client')
            <a href="{{ route('clients.dashboard') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Mi panel</a>
            @elseif (auth()->user()->role === 'entrenador')
            <a href="{{ route('entrenadors.dashboard') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Panel entrenador</a>
            @endif

            <a href="{{ route('profile.edit') }}"
                class="block rounded-lg px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="mt-1 w-full rounded-lg bg-violet-600 px-3 py-2 text-left text-sm font-medium text-white hover:bg-violet-500">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</nav>
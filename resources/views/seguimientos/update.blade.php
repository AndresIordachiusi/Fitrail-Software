<x-app-layout>
    <div class="mx-auto w-full max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
        <section class="rounded-2xl border border-white/10 bg-zinc-950 p-5">
            <div class="mb-6">
                <p class="text-sm text-zinc-400">Panel admin · Seguimiento de cliente</p>
                <h1 class="mt-1 text-2xl font-semibold text-white">Editar seguimiento</h1>
            </div>

            <form method="POST" action="{{ route('admin.seguimientos.update', $seguimiento) }}">
                @method('PUT')
                @include('seguimientos._form', ['buttonText' => 'Actualizar seguimiento'])
            </form>
        </section>
    </div>
</x-app-layout>

<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-white">Crear cliente</h2>
  </x-slot>

  <div class="mx-auto w-full max-w-[1600px] px-4 py-6 sm:px-6 lg:px-8">
    <section class="mx-auto w-full max-w-3xl rounded-2xl border border-white/10 bg-zinc-950 p-6">
      <div class="mb-6 flex items-center justify-between">
        <div>
          <p class="text-sm text-zinc-400">Administración de clientes</p>
          <h1 class="mt-1 text-2xl font-semibold text-white">Nuevo cliente</h1>
        </div>
        <a href="{{ route('clients.index') }}" class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-zinc-200 hover:bg-white/10">
          Volver al listado
        </a>
      </div>

      <form method="POST" action="{{ route('clients.store') }}" class="space-y-5">
        @csrf
        @include('clients._form')
      </form>
    </section>
  </div>
</x-app-layout>

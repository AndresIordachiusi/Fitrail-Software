<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Configura tu perfil
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            
            <div class="p-4 sm:p-8 rounded-xl border border-white/10 bg-zinc-900 shadow shadow-[0_0_30px_0_rgba(255,255,255,0.08)] sm:mx-0">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 rounded-xl border border-white/10 bg-zinc-900 shadow shadow-[0_0_30px_0_rgba(255,255,255,0.08)] sm:mx-0">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 rounded-xl border border-white/10 bg-zinc-900 shadow shadow-[0_0_30px_0_rgba(255,255,255,0.08)] sm:mx-0">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<section>
    <header>
        <h2 class="text-2xl font-semibold tracking-tight text-white">
            Información del perfil
        </h2>

        <p class="mt-1 text-sm text-white/50">
            Actualiza la información de tu perfil y dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

          @if ($user->role === 'admin')
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        @endif

          @if ($user->role === 'client')
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->client->nombre)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        @endif


        @if ($user->role === 'entrenador')
        <div>
            <x-input-label for="name" :value="__('Nombre')" class="text-white" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->entrenador->nombre)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        @endif

        @if ($user->role === 'entrenador')
        <div>
            <x-input-label for="apellido" :value="__('Apellido')" class="text-white" />
            <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                :value="old('apellido', $user->entrenador->apellido)" required autofocus autocomplete="apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
        </div>
        @endif


        @if ($user->role === 'client')
        <div>
            <x-input-label for="apellido" :value="__('Apellido')" class="text-white" />
            <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full"
                :value="old('apellido', $user->client->apellido)" required autofocus autocomplete="apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
        </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-white/50">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-white/90 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        @if ($user->role === 'client')
        <div>
            <x-input-label for="edad" :value="__('Edad')" class="text-white" />
            <x-text-input id="edad" name="edad" type="number" class="mt-1 block w-full"
                :value="old('edad', $user->client->edad)" required autofocus autocomplete="edad" />
            <x-input-error class="mt-2" :messages="$errors->get('edad')" />
        </div>

        <div>
            <x-input-label for="altura" :value="__('Altura')" class="text-white" />
            <x-text-input id="altura" name="altura" type="number" class="mt-1 block w-full"
                :value="old('altura', $user->client->altura)" required autofocus autocomplete="altura" />
            <x-input-error class="mt-2" :messages="$errors->get('altura')" />
        </div>

        <div>
            <x-input-label for="peso" :value="__('Peso (kg)')" class="text-white" />
            <x-text-input id="peso" name="peso" type="number" class="mt-1 block w-full"
                :value="old('peso', $user->client->peso)" required autofocus autocomplete="peso" />
            <x-input-error class="mt-2" :messages="$errors->get('peso')" />
        </div>

        <div>
            <x-input-label for="objetivo" :value="__('Objetivo')" class="text-white" />
            <select name="objetivo"
                class="client-form-field w-full rounded-lg border border-white/10 bg-zinc-900 px-3 py-2 text-zinc-100 outline-none transition focus:border-violet-400/60"
                style="color: #fff;">
                <option value="" style="color: #fff; background-color: #18181b;">Selecciona...</option>
                <option value="perder peso" {{ old('objetivo', $user->client->objetivo) == 'perder peso' ? 'selected' :
                    ''
                    }}>Perder peso</option>
                <option value="ganar masa muscular" {{ old('objetivo', $user->client->objetivo) == 'ganar masa muscular'
                    ?
                    'selected' : '' }}>Ganar masa muscular</option>
                <option value="tonificar" {{ old('objetivo', $user->client->objetivo) == 'tonificar' ? 'selected' : ''
                    }}>Tonificar</option>
                <option value="mantener forma" {{ old('objetivo', $user->client->objetivo) == 'mantener forma' ?
                    'selected' :
                    '' }}>Mantener forma</option>
                <option value="aumentar resistencia" {{ old('objetivo', $user-> client->objetivo) == 'aumentar
                    resistencia' ?
                    'selected' : '' }}>Aumentar resistencia</option>
                <option value="mejorar flexibilidad" {{ old('objetivo', $user->client->objetivo) == 'mejorar
                    flexibilidad' ?
                    'selected' : '' }}>Mejorar flexibilidad</option>
                <option value="recomposición corporal" {{ old('objetivo', $user->client->objetivo) == 'recomposición
                    corporal'
                    ? 'selected' : '' }}>Recomposición corporal</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('objetivo')" />
        </div>
        @endif

        <div class="flex items-center gap-4 text-white/60">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-white">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
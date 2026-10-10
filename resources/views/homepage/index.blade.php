<x-guest-layout>
	<div class="w-full space-y-12 pb-12">

		<section class="hero w-full text-center px-4 sm:px-6 lg:px-8 py-8 sm:py-10" id="hero">

			<h2 class="hero-tagline text-base sm:text-xl lg:text-2xl font-bold text-violet-500 shadow-lg">
				{{ $headerBienvenida->getTagline() }}
			</h2>

			<h1 class="hero-title-1 mt-3 text-4xl sm:text-5xl lg:text-7xl font-bold text-white leading-tight">
				{{ $headerBienvenida->getTitulo() }}
			</h1>

			<h1 class="hero-title-2 text-4xl sm:text-5xl lg:text-7xl font-bold text-white/70 leading-tight">
				{{ $headerBienvenida->getTitulo2() }}
			</h1>

			<p
				class="hero-desc mt-4 sm:mt-5 lg:text-lg text-white/40 max-w-xs sm:max-w-2xl lg:max-w-4xl mx-auto leading-relaxed">
				{{ $headerBienvenida->getDescription() }}
			</p>

			<div class="hero-btn mt-6 flex justify-center">
				<a href="{{ route('register') }}"
					class="inline-flex items-center gap-2 rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
					Comenzar ahora
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
						aria-hidden="true">
						<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
							stroke-width="2" d="M5 12h14m-7 7V5" />
					</svg>
				</a>
			</div>

		</section>


		<section id="" class="space-y-20">
			<div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
				<div>
					<h2 class="text-4xl font-semibold text-white">Simple y efectivo.</h2>
				</div>
			</div>

			<section class="home-preview relative overflow-hidden rounded-3xl border border-white/10 bg-zinc-950">
				<div class="pointer-events-none absolute inset-0">
					<div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-violet-500/25 blur-3xl"></div>
					<div class="absolute -bottom-24 -right-12 h-72 w-72 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
				</div>

				<div class="relative grid grid-cols-1 gap-8 p-8 lg:grid-cols-2 lg:p-12">
					<div class="flex flex-col justify-center">
						<span
							class="w-fit rounded-full border border-violet-400/30 bg-violet-500/10 px-3 py-1 text-xs font-medium uppercase tracking-widest text-violet-200">
							Nuevo ciclo fitness 2026
						</span>

						<h1 class="mt-5 text-4xl font-semibold leading-tight text-white sm:text-5xl">
							Transforma tu energía en resultados reales
						</h1>

						<p class="mt-4 max-w-xl text-sm text-zinc-300 sm:text-base">
							Entrena con un sistema integral de fuerza, movilidad y acompañamiento profesional.
							Este preview muestra cómo se vería la homepage principal del gimnasio con contenido
							dinámico.
						</p>

						<div class="mt-8 flex flex-wrap items-center gap-3">
							<a href="#planes"
								class="rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
								Ver planes
							</a>
							<a href="#clases"
								class="rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 text-sm font-medium text-zinc-200 transition hover:border-violet-400/40 hover:bg-violet-500/10">
								Explorar clases
							</a>
						</div>

						<div class="mt-8 grid grid-cols-3 gap-3 text-center">
							<div class="rounded-xl border border-white/10 bg-white/5 px-3 py-3 ">
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
						</div>
					</div>

					<div class="overflow-hidden rounded-2xl border border-white/10 bg-zinc-900">
						@if($entry && $entry->getBienvenida())
						<img src="https:{{ $entry->getBienvenida()->getFile()->getUrl() }}" alt="Imagen">
						@endif
					</div>
				</div>
			</section>

			<section id="planes" class="space-y-20">
				<div class="flex flex-col justify-between gap-3 md:flex-row md:items-end">
					<div>
						<p class="text-sm text-violet-300">Membresías</p>
						<h2 class="text-4xl font-semibold text-white">Planes para cada objetivo</h2>
					</div>
					<p class="max-w-xl text-sm text-zinc-400">Precios y beneficios de ejemplo para mostrar la estructura
						de
						una sección comercial.</p>
				</div>

				<div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
					<article class="plan-card rounded-2xl border border-white/10 bg-zinc-900 p-6">
						<h3 class="text-lg font-semibold text-white">{{ $planes[2]->getNombre() }}</h3>
						<p class="mt-1 text-sm text-zinc-400">{{ $planes[2]->getDescripcion() }}</p>
						<p class="mt-4 text-3xl font-semibold text-white">{{ $planes[2]->getPrecio() }} €<span
								class="text-sm text-zinc-400">/mes</span>
						</p>
						<ul class="mt-5 space-y-2 text-sm text-zinc-300">
							<li>{{ $planes[2]->getVentaja1() }}</li>
							<li>{{ $planes[2]->getVentaja2() }}</li>
							<li>{{ $planes[2]->getVentaja3() }}</li>

						</ul>
						<button
							class="mt-6 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white transition hover:border-violet-400/40 hover:bg-violet-500/10">
							<a href="{{ route('register') }}">Seleccionar</a></button>
					</article>

					<article
						class="plan-card plan-card--featured rounded-2xl border border-violet-400/40 bg-gradient-to-b from-violet-500/20 to-zinc-900 p-6 shadow-[0_0_40px_rgba(139,92,246,0.25)]">
						<p
							class="w-fit rounded-full border border-violet-300/40 bg-violet-500/20 px-2.5 py-1 text-xs text-violet-100">
							Más popular</p>
						<h3 class="mt-3 text-lg font-semibold text-white">{{ $planes[1]->getNombre() }}</h3>
						<p class="mt-1 text-sm text-zinc-300">{{ $planes[1]->getDescripcion() }}</p>
						<p class="mt-4 text-3xl font-semibold text-white">{{ $planes[1]->getPrecio() }} €<span
								class="text-sm text-zinc-300">/mes</span>
						</p>
						<ul class="mt-5 space-y-2 text-sm text-zinc-200">
							<li> {{ $planes[1]->getVentaja1() }}</li>
							<li> {{ $planes[1]->getVentaja2() }}</li>
							<li> {{ $planes[1]->getVentaja3() }}</li>
						</ul>
						<button
							class="mt-6 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white transition hover:border-violet-400/40 hover:bg-violet-500/10">
							<a href="{{ route('register') }}">Elegir Pro</a></button>
					</article>

					<article class="plan-card rounded-2xl border border-white/10 bg-zinc-900 p-6">
						<h3 class="text-lg font-semibold text-white">{{ $planes[0]->getNombre() }}</h3>
						<p class="mt-1 text-sm text-zinc-400">{{ $planes[0]->getDescripcion() }}</p>
						<p class="mt-4 text-3xl font-semibold text-white">{{ $planes[0]->getPrecio() }} €<span
								class="text-sm text-zinc-400">/mes</span>
						</p>
						<ul class="mt-5 space-y-2 text-sm text-zinc-300">
							<li> {{ $planes[0]->getVentaja1() }}</li>
							<li> {{ $planes[0]->getVentaja2() }}</li>
							<li> {{ $planes[0]->getVentaja3() }}</li>
						</ul>
						<button
							class="mt-6 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white transition hover:border-violet-400/40 hover:bg-violet-500/10">
							<a href="{{ route('register') }}">Solicitar demo</a></button>
					</article>
				</div>
			</section>


			<section id="clases" class="space-y-20">
				<div>
					<p class="text-sm text-violet-300">Entrenamientos</p>
					<h2 class="text-4xl font-semibold text-white">Clases destacadas de la semana</h2>
				</div>

				<div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
					<div class="class-card">
						<img src="https:{{ $entrenamientos[2]->getE1()->getFile()->getUrl() }}" alt="Imagen"
							class="rounded-3xl border border-white/20">

						<div class="px-2 mt-4">
							<p><span class="font-semibold">Poder en cada intervalo.</span> <span
									class=" text-zinc-400">Supera tus límites con ráfagas de energía explosiva. Controla
									tus zonas de frecuencia cardíaca. </span></p>
						</div>
					</div>

					<div class="class-card">
						<img src="https:{{ $entrenamientos[1]->getE1()->getFile()->getUrl() }}" alt="Imagen"
							class="rounded-3xl border border-white/20">
						<div class="px-2 mt-4">
							<p><span class="font-semibold">Espacios perfectos para tu rutina.</span> <span
									class=" text-zinc-400">Te sentira más motivado y con más energía para tus
									entrenamientos.</span></p>
						</div>
					</div>

					<div class="class-card">
						<img src="https:{{ $entrenamientos[0]->getE1()->getFile()->getUrl() }}" alt="Imagen"
							class="rounded-3xl border border-white/20">

						<div class="px-2 mt-4">
							<p><span class="font-semibold">Entrenadores expertos.</span> <span
									class=" text-zinc-400">Comprometidos con tu progeso y resultados. </span></p>
						</div>
					</div>

				</div>
			</section>

			<section class="space-y-10">

				<div
					class="logros max-w-7xl mx-auto p-5 pb-12 bg-zinc-900 rounded-2xl border border-white/10 border-b-0 [mask-image:linear-gradient(to_bottom,black_60%,transparent_100%)] [-webkit-mask-image:linear-gradient(to_bottom,black_60%,transparent_100%)]">

					<div class="px-4">
						<h2 class="text-3xl mt-3 font-semibold text-white">Nuestros logros</h2>
					</div>
					<div class="mt-8 grid grid-cols-3 gap-3 text-center">
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
					</div>
				</div>

				<div class="btn-exper flex justify-center mt-2 pb-8 mb-8">
					<a href="{{ route('register') }}"
						class="inline-flex items-center mt-2 gap-2 rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
						Unete a esta experiencia
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							aria-hidden="true">
							<path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
								stroke-width="2" d="M5 12h14m-7 7V5" />
						</svg>
					</a>
				</div>
			</section>
</x-guest-layout>


<section class="relative z-10 -mt-16 w-full rounded-t-[3rem] bg-white px-6 pt-16 pb-20 ">

	<div class="max-w-7xl mx-auto space-y-8">

		<section class="space-y-6">
			<div>
				<h2 class="text-3xl text-black font-semibold">Caso de éxito de nuestros clientes</h2>
			</div>

			<div class="grid grid-cols-1 gap-4 lg:grid-cols-3" id="casos-exito">
				<blockquote
					class="testimonial-card rounded-2xl border border-white/10 bg-zinc-900 p-6 text-zinc-200 shadow-lg">
					<div
						class="inline-flex w-fit items-center rounded-lg border border-violet-500/30 bg-violet-500/15 px-2 py-1 text-xs text-zinc-200">
						<p class="font-semibold">Caso de éxito</p>
					</div>
					<p class="mt-2 font-semibold">“El cambio en mi energía fue brutal desde el primer mes. El ambiente
						motiva muchísimo.”</p>
					<footer class="mt-4 text-sm text-zinc-400">— Sofía Marquez</footer>
				</blockquote>
				<blockquote
					class="testimonial-card rounded-2xl border border-white/10 bg-zinc-900 p-6 text-zinc-200 shadow-lg">
					<div
						class="inline-flex w-fit items-center rounded-lg border border-violet-500/30 bg-violet-500/15 px-2 py-1 text-xs text-zinc-200">
						<p class="font-semibold">Caso de éxito</p>
					</div>
					<p class="mt-2 font-semibold">“Las clases están súper bien organizadas y los coaches corrigen cada
						detalle técnico.”</p>
					<footer class="mt-4 text-sm text-zinc-400">— Diego R</footer>
				</blockquote>
				<blockquote class="testimonial-card rounded-2xl border border-white/10 bg-zinc-900 p-6 text-zinc-200">
					<div
						class="inline-flex w-fit items-center rounded-lg border border-violet-500/30 bg-violet-500/15 px-2 py-1 text-xs text-zinc-200">
						<p class="font-semibold">Caso de éxito</p>
					</div>
					<p class="mt-2 font-semibold">“Por primera vez logré mantener constancia. Todo está pensado para
						progresar de verdad.”</p>
					<footer class="mt-4 text-sm text-zinc-400">— Carla T</footer>
				</blockquote>

			</div>
		</section>

		<div class="mt-8">
			<h2 class="text-3xl text-black font-semibold">Nuestras campañas de apoyo</h2>
		</div>

		<div class="testimonial-card  grid grid-cols-2 gap-5 pb-6 mb-10 lg:grid-cols-2" id="campañas">

			<div class="space-y-4">
				<h2 class=" mt-2 text-3xl font-semibold">Conoce.</h2>
				<h2 class=" mt-2 text-3xl font-semibold">Arriesgate a entrenar.</h2>

				<h2 class="mt-4 flex text-base justify-start">Somos un gimnasio incluyente que aporta valor a tu vida
					saludable, por lo que
					somos conscientes de la salud de todos.</h2>
			</div>

			<div class="mt-8 grid grid-cols-1 gap-3 lg:grid-cols-3 text-center">
				<div
					class="rounded-xl border border-violet-500/30 bg-violet-500/10 px-4 py-2 shadow-md text-sm font-semibold text-violet-700 transition duration-200 hover:border-violet-500/50 hover:bg-violet-500/20">
					<p class="text-xl font-semibold text-black">Impulso Joven</p>
					<div class="mt-3 flex justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
							<path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
								stroke-width="4"
								d="M6 33v6a3 3 0 0 0 3 3h6m18 0h6a3 3 0 0 0 3-3v-6m0-18V9a3 3 0 0 0-3-3h-6M6 15V9a3 3 0 0 1 3-3h6m19 18L24 34L14 24c-1-1-1.5-3 0-5s4.5-2 6-1s2 2 4 2s2.5-1 4-2s4.5-1 6 1s1 4 0 5" />
						</svg>
					</div>
				</div>
				<div
					class="rounded-xl border border-violet-500/30 bg-violet-500/10 px-4 py-2 shadow-md text-sm font-semibold text-violet-700 transition duration-200 hover:border-violet-500/50 hover:bg-violet-500/20">
					<p class="text-xl font-semibold text-black">Familia en Forma</p>

					<div class="mt-4 flex justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
							<g fill="none" stroke="#000" stroke-linecap="round" stroke-width="4">
								<path
									d="M10 19s-5.143 2-6 9m34-9s5.143 2 6 9m-26-9s4.8 1.167 6 7m6-7s-4.8 1.167-6 7m-4 8s-4.2.75-6 6m14-6s4.2.75 6 6" />
								<circle cx="24" cy="31" r="5" stroke-linejoin="round" />
								<circle cx="34" cy="14" r="6" stroke-linejoin="round" />
								<circle cx="14" cy="14" r="6" stroke-linejoin="round" />
							</g>
						</svg>
					</div>

				</div>
				<div
					class="rounded-xl border border-violet-500/30 bg-violet-500/10 px-4 py-2 shadow-md text-sm font-semibold text-violet-700 transition duration-200 hover:border-violet-500/50 hover:bg-violet-500/20">
					<p class="text-xl font-semibold text-black">Reto 30 Días</p>

					<div class="mt-3 flex justify-center">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
							<circle cx="24" cy="24" r="21.5" fill="none" stroke="#000" stroke-linecap="round"
								stroke-linejoin="round" stroke-width="1" />
							<circle cx="12.014" cy="14.078" r="1.5" fill="none" stroke="#000" stroke-linecap="round"
								stroke-linejoin="round" stroke-width="1" />
							<path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
								d="M13.068 13.011a15.476 15.476 0 1 1-1.906 2.3" stroke-width="1" />
							<path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
								d="M25.525 26.159a4.238 4.238 0 0 0 8.475 0V21.84a4.238 4.238 0 0 0-8.475 0Zm-6.247-2.157a3.2 3.2 0 0 0 3.197-3.198h0a3.2 3.2 0 0 0-3.197-3.197m0 12.789a3.2 3.2 0 0 0 3.197-3.197v0a3.2 3.2 0 0 0-3.197-3.197m-5.277 5.315c.884.74 1.837 1.08 3.978 1.08h1.299"
								stroke-width="1" />
							<path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
								d="M14 18.672c.885-.738 1.84-1.074 3.98-1.068l1.3.003m-3.26 6.395h3.258"
								stroke-width="1" />
						</svg>
					</div>

				</div>


			</div>


		</div>
	</div>


</section>

<section class="relative z-10 mt-12 w-full rounded-t-[3rem] bg-black px-6 pt-16 pb-20 shadow-none">
	<div class="max-w-7xl mx-auto space-y-8">
		<section class="hero w-full text-center px-4 sm:px-6 lg:px-8 py-8 sm:py-10">



			<h1 class="hero-title-2 text-2xl sm:text-5xl lg:text-3xl font-bold text-white/90 leading-tight">
				¿Quieres crecer con Fitrail?
			</h1>

			<p
				class="hero-desc mt-4 sm:mt-5 lg:text-lg text-white/50 max-w-xs sm:max-w-2xl lg:max-w-4xl mx-auto leading-relaxed">
				Únete a nuestra comunidad y comienza tu viaje hacia una mejor versión de ti mismo.
			</p>

			<div class="hero-btn mt-6 flex justify-center gap-4">
				<a href="{{ route('register') }}"
					class="inline-flex items-center gap-2 rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
					Registrate
				</a>
				<a href="#planes"
					class="inline-flex items-center gap-2 rounded-xl border border-violet-500/30 bg-violet-500/15 px-5 py-2.5 text-sm font-semibold text-violet-100 transition hover:border-violet-400/40 hover:bg-violet-500/25">
					Planes
				</a>
			</div>


		</section>

	</div>

</section>
<footer class="border-t border-black/10 bg-white">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">

		<div class="grid gap-10 md:grid-cols-3">
			<section class="space-y-3">
				<h2 class="text-2xl font-bold text-black">G-Fitrail</h2>
				<p class="text-sm text-zinc-600">
					Entrenamiento, comunidad y resultados reales para transformar tu estilo de vida.
				</p>
			</section>

			<nav aria-label="Enlaces del sitio" class="space-y-3">
				<h3 class="text-lg font-semibold text-black">Enlaces útiles</h3>
				<ul class="space-y-2 text-sm">
					<li><a href="#hero" class="text-zinc-700 transition hover:text-violet-600">Inicio</a></li>
					<li><a href="#planes" class="text-zinc-700 transition hover:text-violet-600">Planes</a></li>
					<li><a href="#clases" class="text-zinc-700 transition hover:text-violet-600">Entrenamientos</a></li>
					<li><a href="#casos-exito" class="text-zinc-700 transition hover:text-violet-600">Casos de éxito</a>
					</li>
					<li><a href="#campañas" class="text-zinc-700 transition hover:text-violet-600">Campañas</a></li>
				</ul>
			</nav>

			<section class="space-y-3">
				<h3 class="text-lg font-semibold text-black">Comienza hoy</h3>
				<p class="text-sm text-zinc-600">Únete y accede a todos nuestros planes y clases.</p>
				<a href="{{ route('register') }}"
					class="inline-flex items-center gap-2 rounded-xl border border-violet-500/30 bg-violet-500/10 px-4 py-2 text-sm font-semibold text-violet-700 transition hover:border-violet-500/50 hover:bg-violet-500/20">
					Crear cuenta
				</a>
			</section>
		</div>

		<div
			class="flex flex-col gap-3 border-t border-black/10 pt-6 text-sm text-zinc-500 sm:flex-row sm:items-center sm:justify-between">
			<p>© {{ date('Y') }} G-Fitrail. Todos los derechos reservados.</p>
			<a href="#hero" class="font-medium text-zinc-700 transition hover:text-violet-600">Volver arriba ↑</a>
		</div>

	</div>
</footer>
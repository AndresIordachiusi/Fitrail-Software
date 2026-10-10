<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-xl text-white border border-violet-500/30 bg-violet-500/15 px-4 py-2 text-sm font-semibold transition duration-300 hover:border-violet-400/40 hover:bg-violet-500/10']) }}>
    {{ $slot }}
</button>

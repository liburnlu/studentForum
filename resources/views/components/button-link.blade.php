<a {{ $attributes->merge([
    'class' => 'group relative inline-flex items-center overflow-hidden rounded-lg bg-indigo-600 px-8 py-3 text-white hover:bg-indigo-700 transition-colors'
]) }}>
    <span class="absolute -start-full transition-all group-hover:start-4">
        <svg class="size-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
    </span>

    <span class="text-sm font-medium transition-all group-hover:ms-4">
        {{ $slot }}
    </span>
</a>

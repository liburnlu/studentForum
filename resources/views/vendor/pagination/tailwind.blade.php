@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-6">
        {{-- Mobile --}}
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm text-gray-400 border border-gray-300 rounded-md cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-4 py-2 text-sm text-indigo-600 border border-gray-300 rounded-md hover:bg-indigo-50 transition">
                    Previous
                </a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-4 py-2 ml-3 text-sm text-indigo-600 border border-gray-300 rounded-md hover:bg-indigo-50 transition">
                    Next
                </a>
            @else
                <span class="px-4 py-2 ml-3 text-sm text-gray-400 border border-gray-300 rounded-md cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-center">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page --}}
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center px-2 py-2 text-sm text-gray-400 border border-gray-300 rounded-l-md cursor-not-allowed">
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="inline-flex items-center px-2 py-2 text-sm text-indigo-600 border border-gray-300 rounded-l-md hover:bg-indigo-50 transition">
                            ‹
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Dots --}}
                        @if (is_string($element))
                            <span class="inline-flex items-center px-4 py-2 text-sm text-gray-500 border border-gray-300">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Page Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold
                                            bg-indigo-600 text-white border border-indigo-600 cursor-default">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium
                                       text-gray-700 bg-white border border-gray-300
                                       hover:bg-indigo-50 hover:text-indigo-700 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="inline-flex items-center px-2 py-2 text-sm text-indigo-600 border border-gray-300 rounded-r-md hover:bg-indigo-50 transition">
                            ›
                        </a>
                    @else
                        <span class="inline-flex items-center px-2 py-2 text-sm text-gray-400 border border-gray-300 rounded-r-md cursor-not-allowed">
                            ›
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

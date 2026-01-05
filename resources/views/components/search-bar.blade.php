@props(['name' , 'route', 'resource'=>null])

<div class="mb-4 max-w-7xl mx-auto">
    <form method="GET" action="{{ route($route,$resource) }}" class="flex items-center gap-2">
        <div class="flex-1 relative max-w-xs">
            <input
                type="text"
                name="search"
                placeholder="{{$name}}"
                value="{{ request('search') }}"
                class="w-full px-3 py-2 pl-8 text-md border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-600 focus:border-transparent"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <button
            type="submit"
            class="px-5 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-normal text-md"
        >
            Search
        </button>
        @if(request('search'))
            <a
                href="{{ route($route, $resource) }}"
                class="px-5 py-1.5 text-gray-600 hover:text-gray-900 font-normal text-md border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
            >
                Clear
            </a>
        @endif
    </form>
</div>

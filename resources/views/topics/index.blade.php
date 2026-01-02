<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                Forum Topics
            </h2>

            <x-button-link href="{{ route('topics.create') }}">
                Create Topic
            </x-button-link>
        </div>
    </x-slot>

    <!-- Page Background -->
    <div class="bg-white min-h-screen py-6">

        <!-- Filters & Search -->
        <div class="flex flex-wrap justify-between items-center gap-6 max-w-7xl mx-auto px-6 mb-6">

            <!-- Category & Sort Filters -->
            <div class="flex flex-wrap gap-4">
                <!-- Category Filter -->
                <form method="GET" action="/topics">
                    <details class="group w-64 bg-white rounded shadow-sm border border-gray-200">
                        <summary
                            class="flex items-center justify-between p-2 text-gray-700 cursor-pointer [&::-webkit-details-marker]:hidden">
                            <span class="font-medium text-sm">Filter / Category</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="w-4 h-4 transition-transform group-open:-rotate-180">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </summary>
                        <div class="p-3 space-y-2">
                            @foreach($categories as $category)
                                <label class="inline-flex items-center gap-2 text-gray-700">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           class="rounded border-gray-300"
                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                    <span class="text-sm">{{ $category->name }}</span>
                                </label>
                            @endforeach
                            <div class="flex justify-between mt-2">
                                <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                                    Filter
                                </button>
                                <a href="{{ route('topics.index') }}" class="text-sm text-gray-700 underline hover:text-gray-900">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </details>
                </form>

                <!-- Sort By -->
                <form method="GET" action="/topics">
                    <details class="group w-56 bg-white rounded shadow-sm border border-gray-200">
                        <summary
                            class="flex items-center justify-between p-2 text-gray-700 cursor-pointer [&::-webkit-details-marker]:hidden">
                            <span class="font-medium text-sm">Sort by</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="w-4 h-4 transition-transform group-open:-rotate-180">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </summary>
                        <div class="p-2 flex flex-col divide-y divide-gray-200">
                            <button type="submit" name="sort" value="views" class="px-2 py-2 text-left text-gray-700 hover:bg-gray-50 text-sm">Most views</button>
                            <button type="submit" name="sort" value="replies" class="px-2 py-2 text-left text-gray-700 hover:bg-gray-50 text-sm">Most replies</button>
                        </div>
                    </details>
                </form>
            </div>

            <!-- Search -->
            <div class="w-full sm:w-64">
                <form action="/topics" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search for a topic"
                               value="{{ request()->input('search') }}"
                               class="w-full rounded border-gray-300 pl-3 pr-10 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 text-gray-700 rounded hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.2-5.2M5.2 5.2a7.5 7.5 0 1010.6 10.6 7.5 7.5 0 00-10.6-10.6z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Topics List -->
        <div class="max-w-7xl mx-auto px-6 space-y-4">
            @foreach($topics as $topic)
                <article class="bg-white shadow-md rounded-xl border border-gray-200 hover:shadow-lg transition-all duration-200">
                    <div class="p-6 flex gap-4">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <!-- Top Row: Category + Heart -->
                            <div class="flex justify-between items-center mb-2">
                                <span class="inline-flex items-center rounded-md bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                    {{ $topic->category->name }}
                                </span>


                                @auth
                                <!-- Bookmark Heart -->
                                <form method="POST" action="/bookmarks" class="relative">
                                    @csrf
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                                    <button type="submit"
                                            class="transform hover:scale-125 transition-transform duration-200 text-2xl
                                            {{ $topic->bookmarks->isNotEmpty() ? 'text-red-600' : 'text-gray-400 hover:text-red-600' }}">
                                        &#10084;
                                    </button>
                                </form>
                                @endauth

                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ route('topics.show', $topic) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ $topic->title }}
                                </a>
                            </h3>

                            <!-- Description -->
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                {{ Str::limit($topic->description, 200) }}
                            </p>

                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                <div class="flex items-center gap-1">
                                    <span class="font-medium text-gray-700">{{ $topic->user->name ?? 'Deleted User' }}</span>
                                </div>
                                <span class="text-gray-300">•</span>
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $topic->created_at->diffForHumans() }}</span>
                                </div>

                                <span class="text-gray-300">•</span>

                                <!-- Replies -->
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span class="font-medium">{{ $topic->replies_count ?? $topic->replies->count()}}</span>
                                </div>

                                <span class="text-gray-300">•</span>

                                <!-- Views -->
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>{{ $topic->views }}</span>
                                </div>

                                <!-- Last reply -->
                                @if($topic->replies_count > 0)
                                    <span class="text-gray-300">•</span>
                                    <div class="flex items-center gap-1 text-xs">
                                        <span class="text-gray-400">Last reply by</span>
                                        <span class="font-medium text-gray-600">{{ $topic->latestReply->user->name }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

            {{ $topics->withQueryString()->links() }}
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

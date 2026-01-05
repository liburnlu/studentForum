<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Forum Topics
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ number_format($topics->total()) }}</span> topics in our community
                </p>
            </div>

            @auth
            <x-button-link href="{{ route('topics.create') }}">
                Create Topic
            </x-button-link>
            @endauth
        </div>
    </x-slot>

    <!-- Page Background -->
    <div class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen py-8">

        <!-- Success Toast -->
        @if(session('success'))
            <x-success-toast></x-success-toast>
        @endif


        <!-- Filters & Search Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-wrap justify-between items-center gap-6">

                    <!-- Category & Sort Filters -->
                    <div class="flex flex-wrap gap-4">
                        <!-- Category Filter -->
                        <form method="GET" action="/topics">
                            <details class="group w-64 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-indigo-300 transition-colors">
                                <summary
                                    class="flex items-center justify-between p-3 text-gray-700 cursor-pointer [&::-webkit-details-marker]:hidden">
                                    <span class="font-semibold text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        Filter by Category
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="w-5 h-5 transition-transform group-open:-rotate-180 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </summary>
                                <div class="p-4 space-y-3 border-t border-gray-100">
                                    @foreach($categories as $category)
                                        <label class="flex items-center gap-3 text-gray-700 hover:bg-gray-50 p-2 rounded cursor-pointer transition-colors">
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                            <span class="text-sm font-medium">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                    <div class="flex justify-between mt-4 pt-3 border-t border-gray-100">
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium shadow-sm transition-colors">
                                            Apply Filter
                                        </button>
                                        <a href="{{ route('topics.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 font-medium transition-colors">
                                            Clear All
                                        </a>
                                    </div>
                                </div>
                            </details>
                        </form>

                        <!-- Sort By -->
                        <form method="GET" action="/topics">
                            <details class="group w-56 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-indigo-300 transition-colors">
                                <summary
                                    class="flex items-center justify-between p-3 text-gray-700 cursor-pointer [&::-webkit-details-marker]:hidden">
                                    <span class="font-semibold text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                        Sort by
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="w-5 h-5 transition-transform group-open:-rotate-180 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </summary>
                                <div class="p-2 flex flex-col border-t border-gray-100">
                                    <button type="submit" name="sort" value="views" class="px-3 py-2.5 text-left text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-md text-sm font-medium transition-colors">
                                        Most Views
                                    </button>
                                    <button type="submit" name="sort" value="replies" class="px-3 py-2.5 text-left text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-md text-sm font-medium transition-colors">
                                        Most Replies
                                    </button>
                                </div>
                            </details>
                        </form>
                    </div>

                    <!-- Search -->
                    <div class="w-full sm:w-80">
                        <form action="/topics" method="GET">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.2-5.2M5.2 5.2a7.5 7.5 0 1010.6 10.6 7.5 7.5 0 00-10.6-10.6z"/>
                                    </svg>
                                </div>
                                <input type="text" name="search" placeholder="Search topics..."
                                       value="{{ request()->input('search') }}"
                                       class="w-full rounded-lg border-gray-300 pl-10 pr-4 py-2.5 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Topics List -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            @foreach($topics as $topic)
                <article class="bg-white shadow-sm rounded-xl border border-gray-200 hover:shadow-md hover:border-indigo-200 transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex gap-5">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                <div class="h-14 w-14 rounded-full bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-4 ring-indigo-50">
                                    {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <!-- Top Row: Category + Heart -->
                                <div class="flex justify-between items-start mb-3">
                                    <span class="inline-flex items-center rounded-full bg-gradient-to-r from-indigo-50 to-indigo-100 px-4 py-1.5 text-sm font-bold text-indigo-700 ring-1 ring-inset ring-indigo-600/20 shadow-sm">
                                        {{ $topic->category->name }}
                                    </span>

                                    @auth
                                        <!-- Bookmark Heart -->
                                        <form method="POST" action="/bookmarks" class="relative">
                                            @csrf
                                            <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                                            <button type="submit"
                                                    class="transform hover:scale-110 transition-all duration-200 text-2xl p-1 rounded-full hover:bg-red-50
                                                {{ $topic->bookmarks->isNotEmpty() ? 'text-red-500' : 'text-gray-300 hover:text-red-500' }}">
                                                {{ $topic->bookmarks->isNotEmpty() ? '❤️' : '🤍' }}
                                            </button>
                                        </form>
                                    @endauth
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('topics.show', $topic) }}" class="hover:text-indigo-600 transition-colors">
                                        {{ $topic->title }}
                                    </a>
                                </h3>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($topic->description, 200) }}
                                </p>

                                <!-- Meta Info -->
                                <div class="flex flex-wrap items-center gap-3 text-xs">
                                    <div class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="font-semibold text-gray-700">{{ $topic->user->name ?? 'Deleted User' }}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-gray-600">{{ $topic->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Replies -->
                                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span class="font-semibold text-blue-700">{{ $topic->replies_count }} replies</span>
                                    </div>

                                    <!-- Views -->
                                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span class="font-semibold text-purple-700">{{ $topic->views }} views</span>
                                    </div>

                                    <!-- Last reply -->
                                    @if($topic->replies_count > 0)
                                        <div class="flex items-center gap-2 px-3 py-1.5 bg-green-50 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-gray-600">Last reply by</span>
                                            <span class="font-semibold text-green-700">{{ $topic->latestReply->user->name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach

            <div class="mt-8">
                {{ $topics->withQueryString()->links() }}
            </div>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

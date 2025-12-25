<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Forum Topics
            </h2>
            @auth
                <a href="{{ route('topics.create') }}"
                   class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Topic
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @foreach($topics as $topic)
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-100 transition-all duration-200">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <!-- Left: User Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                                    </div>
                                </div>

                                <!-- Right: Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Top Row: Category + Badges -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="inline-flex items-center rounded-md bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                            {{ $topic->category->name }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                        <a href="{{ route('topics.show', $topic) }}" class="hover:text-indigo-600 transition-colors">
                                            {{ $topic->title }}
                                        </a>
                                    </h3>

                                    <!-- Content Preview -->
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                        {{ Str::limit($topic->description, 200) }}
                                    </p>

                                    <!-- Meta Information -->
                                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                        <!-- Author -->
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-medium text-gray-700">{{ $topic->user->name }}</span>
                                        </div>

                                        <span class="text-gray-300">•</span>

                                        <!-- Time -->
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $topic->created_at->diffForHumans() }}</span>
                                        </div>

                                        <span class="text-gray-300">•</span>

                                        <!-- Replies -->
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            <span class="font-medium">{{ $topic->replies->count() }}</span>
                                        </div>

                                        <span class="text-gray-300">•</span>

                                        <!-- Views -->
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>{{ $topic->views }}</span>
                                        </div>

                                        <!-- Last Reply (if exists) -->
                                        @if($topic->replies->count() > 0)
                                            <span class="text-gray-300">•</span>
                                            <div class="flex items-center gap-1 text-xs">
                                                <span class="text-gray-400">Last reply by</span>
                                                <span class="font-medium text-gray-600">{{ $topic->replies->last()->user->name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                @endforeach
            </div>



        </div>
    </div>
</x-app-layout>

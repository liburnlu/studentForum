<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    My Bookmarks
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ $bookmarks->count() }}</span> bookmarked topics
                </p>
            </div>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-gray-50 to-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($bookmarks->isEmpty())
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">No bookmarks yet</h3>
                    <p class="mt-2 text-gray-600">Start bookmarking topics to keep track of your favorites.</p>
                    <a href="{{ route('topics.index') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold">
                        Browse Topics
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                        <div class="grid grid-cols-12 gap-4 items-center font-semibold text-sm text-indigo-900">
                            <div class="col-span-1">Author</div>
                            <div class="col-span-6">Topic</div>
                            <div class="col-span-2">Category</div>
                            <div class="col-span-2">Stats</div>
                            <div class="col-span-1 text-center">Action</div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-gray-200">
                        @foreach($bookmarks as $bookmark)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <!-- Avatar Column -->
                                    <div class="col-span-1">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-indigo-50">
                                            {{ strtoupper(substr($bookmark->topic->user->name, 0, 1)) }}
                                        </div>
                                    </div>

                                    <!-- Topic Column -->
                                    <div class="col-span-6">
                                        <a href="{{ route('topics.show', $bookmark->topic) }}" class="group">
                                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1 mb-1">
                                                {{ $bookmark->topic->title }}
                                            </h3>
                                            <p class="text-sm text-gray-600 line-clamp-1">
                                                {{ Str::limit($bookmark->topic->description, 120) }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                                <span class="font-medium">{{ $bookmark->topic->user->name }}</span>
                                                <span>•</span>
                                                <span>{{ $bookmark->topic->created_at->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Category Column -->
                                    <div class="col-span-2">
                                        <span class="inline-flex items-center rounded-full bg-gradient-to-r from-indigo-50 to-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                                            {{ $bookmark->topic->category->name }}
                                        </span>
                                    </div>

                                    <!-- Stats Column -->
                                    <div class="col-span-2">
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex items-center gap-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                <span class="font-semibold text-blue-700">{{ $bookmark->topic->replies_count }}</span>
                                                <span class="text-gray-600">replies</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span class="font-semibold text-purple-700">{{ $bookmark->topic->views }}</span>
                                                <span class="text-gray-600">views</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Column -->
                                    <div class="col-span-1 flex justify-center">
                                        <form method="POST" action="{{ route('bookmarks.toggle') }}">
                                            @csrf
                                            <input type="hidden" name="topic_id" value="{{ $bookmark->topic->id }}">
                                            <button type="submit" class="transform hover:scale-110 transition-all duration-200 text-2xl p-1 rounded-full hover:bg-red-50 text-red-500" title="Remove bookmark">
                                                ❤️
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($bookmarks->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $bookmarks->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

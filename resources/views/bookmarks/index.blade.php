<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Bookmarks
            </h2>
        </div>
    </x-slot>

    <div class="bg-white min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4">
            @if($bookmarks->isEmpty())
                <p class="text-gray-600 text-center mt-10">You haven't bookmarked any topics yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($bookmarks as $bookmark)
                        <article class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-200 border border-gray-200">
                            <div class="p-5 flex flex-col sm:flex-row gap-4">
                                <!-- Left: Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold text-lg">
                                        {{ strtoupper(substr($bookmark->topic->user->name, 0, 1)) }}
                                    </div>
                                </div>

                                <!-- Right: Content -->
                                <div class="flex-1 min-w-0 flex flex-col">
                                    <div class="flex justify-between items-start mb-2">
                                        <!-- Category -->
                                        <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-0.5 text-xs font-medium text-indigo-700">
                                            {{ $bookmark->topic->category->name }}
                                        </span>

                                        <!-- Heart / Unbookmark -->
                                        <form method="POST" action="{{ route('bookmarks.toggle') }}">
                                            @csrf
                                            <input type="hidden" name="topic_id" value="{{ $bookmark->topic->id }}">
                                            <button type="submit" class="text-red-600 hover:text-red-800 transform hover:scale-125 transition-transform duration-200 text-2xl">
                                                &#10084;
                                            </button>
                                        </form>

                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('topics.show', $bookmark->topic) }}" class="hover:text-indigo-600 transition-colors">
                                            {{ $bookmark->topic->title }}
                                        </a>
                                    </h3>

                                    <!-- Content Preview -->
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($bookmark->topic->description, 180) }}
                                    </p>

                                    <!-- Meta Information -->
                                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                                        <span class="font-medium text-gray-700">{{ $bookmark->topic->user->name }}</span>
                                        <span>•</span>
                                        <span>{{ $bookmark->topic->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

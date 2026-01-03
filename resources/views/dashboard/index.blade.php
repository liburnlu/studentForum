<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Welcome back! Here's your activity overview.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">

        <!-- Sidebar -->
        @include('layouts.user-sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-8">

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- My Topics -->
                <x-dashboard-stat name="My Topics">
                    {{ $stats['topics'] ?? 0 }}
                </x-dashboard-stat>

                <!-- My Replies -->
                <x-dashboard-stat name="My replies">
                    {{ $stats['replies'] ?? 0 }}
                </x-dashboard-stat>

                <!-- Bookmarks -->
                <x-dashboard-stat name="Bookmarked topics">
                    {{ $stats['bookmarks'] ?? 0 }}
                </x-dashboard-stat>

                <!-- Views -->
                <x-dashboard-stat name="Total views">
                    {{ $stats['views'] ?? 0 }}
                </x-dashboard-stat>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Latest Topics -->
                <section class="bg-white rounded-xl border border-gray-200 shadow-md">
                    <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-base font-bold text-gray-900">Latest Topics</h3>
                        <a href="/dashboard/topics"
                           class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                            View all →
                        </a>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($latestTopics as $topic)
                            <a href="{{ route('topics.show', $topic) }}"
                               class="block px-6 py-4 hover:bg-indigo-50 transition-colors group">
                                <p class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 line-clamp-1 transition-colors">
                                    {{ $topic->title }}
                                </p>

                                <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span class="text-gray-300">•</span>
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span class="font-medium text-blue-700">{{ $topic->replies_count }}</span>
                                        <span>replies</span>
                                    </div>
                                    <span class="text-gray-300">•</span>
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="font-medium text-purple-700">{{ $topic->views }}</span>
                                        <span>views</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-900">No topics yet</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Start creating topics to share your thoughts with the community.
                                </p>
                                <a href="{{ route('topics.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-semibold">
                                    Create your first topic
                                </a>
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Latest Replies -->
                <section class="bg-white rounded-xl border border-gray-200 shadow-md">
                    <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-base font-bold text-gray-900">Latest Replies</h3>
                        <a href="/dashboard/replies"
                           class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                            View all →
                        </a>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($latestReplies as $reply)
                            <a href="{{ route('topics.show', $reply->topic) }}"
                               class="block px-6 py-4 hover:bg-indigo-50 transition-colors group">
                                <p class="text-sm text-gray-700 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($reply->description, 120) }}
                                </p>

                                <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">
                                    <span>on</span>
                                    <span class="font-semibold text-indigo-600 group-hover:text-indigo-700 line-clamp-1">
                                        {{ $reply->topic->title }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">
                                    You haven't replied to any topics yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>

            </div>
        </main>
    </div>
</x-app-layout>

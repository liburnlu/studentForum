<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100 ">

        <!-- Sidebar -->
        @include('layouts.user-sidebar')


        <!-- Main Content -->
        <main class="flex-1 p-6">


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
                <section class="bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between px-6 py-4 border-b">
                        <h3 class="text-sm font-semibold text-gray-700">Latest Topics</h3>
                        <a href="/dashboard/topics"
                           class="text-xs text-indigo-600 hover:underline">
                            View all
                        </a>
                    </div>

                    <div class="divide-y">
                        @forelse($latestTopics as $topic)
                            <a href="{{ route('topics.show', $topic) }}"
                               class="block px-6 py-4 hover:bg-gray-50 transition">
                                <p class="text-sm font-medium text-gray-900 line-clamp-1">
                                    {{ $topic->title }}
                                </p>

                                <div class="mt-1 flex items-center gap-3 text-xs text-gray-500">
                                    <span>{{ $topic->created_at->diffForHumans() }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{     $topic->replies->count() }} replies</span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $topic->views }} views</span>
                                </div>
                            </a>
                        @empty
                            <p class="px-6 py-4 text-sm text-gray-500">
                                You haven’t created any topics yet.
                            </p>
                        @endforelse
                    </div>
                </section>

                <!-- Latest Replies -->
                <section class="bg-white rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between px-6 py-4 border-b">
                        <h3 class="text-sm font-semibold text-gray-700">Latest Replies</h3>
                        <a href="/dashboard/replies"
                           class="text-xs text-indigo-600 hover:underline">
                            View all
                        </a>
                    </div>

                    <div class="divide-y">
                        @forelse($latestReplies as $reply)
                            <a href="{{ route('topics.show', $reply->topic) }}"
                               class="block px-6 py-4 hover:bg-gray-50 transition">
                                <p class="text-sm text-gray-800 line-clamp-2">
                                    {{ Str::limit($reply->description, 120) }}
                                </p>

                                <div class="mt-1 flex items-center gap-2 text-xs text-gray-500">
                                    <span>on</span>
                                    <span class="font-medium text-gray-700">
                            {{ $reply->topic->title }}
                        </span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @empty
                            <p class="px-6 py-4 text-sm text-gray-500">
                                You haven’t replied to any topics yet.
                            </p>
                        @endforelse
                    </div>
                </section>

            </div>
        </main>


    </div>
</x-app-layout>

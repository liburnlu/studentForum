<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            My Topics
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        @include('layouts.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">All Topics</h3>
                    <a href="/dashboard" class="text-xs text-indigo-600 hover:underline">
                        Back to Dashboard
                    </a>
                </div>

                <div class="divide-y">
                    @forelse($topics as $topic)
                        <a href="{{ route('topics.show', $topic) }}"
                           class="block px-6 py-4 hover:bg-gray-50 transition">
                            <p class="text-sm font-medium text-gray-900 line-clamp-2">
                                {{ $topic->title }}
                            </p>

                            <div class="mt-1 flex items-center gap-3 text-xs text-gray-500">
                                <span>{{ $topic->created_at->diffForHumans() }}</span>
                                <span class="text-gray-300">•</span>
                                <span>{{ $topic->replies_count ?? $topic->replies->count() }} replies</span>
                                <span class="text-gray-300">•</span>
                                <span>{{ $topic->views }} views</span>
                            </div>
                        </a>
                    @empty
                        <p class="px-6 py-4 text-sm text-gray-500">
                            No topics yet.
                        </p>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4">
                    {{ $topics->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

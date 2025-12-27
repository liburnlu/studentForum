<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Replies') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        @include('layouts.sidebar') {{-- reuse your sidebar component --}}

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">All Replies</h3>
                    <a href="/dashboard" class="text-xs text-indigo-600 hover:underline">
                        Back to Dashboard
                    </a>
                </div>

                <div class="divide-y">
                    @forelse($replies as $reply)
                        <a href="{{ route('topics.show', $reply->topic) }}"
                           class="block px-6 py-4 hover:bg-gray-50 transition">
                            <p class="text-sm text-gray-800 line-clamp-2">
                                {{ Str::limit($reply->description, 200) }}
                            </p>

                            <div class="mt-1 flex items-center gap-2 text-xs text-gray-500">
                                <span>on</span>
                                <span class="font-medium text-gray-700">{{ $reply->topic->title }}</span>
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

                {{-- Pagination --}}
                <div class="px-6 py-4">
                    {{ $replies->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

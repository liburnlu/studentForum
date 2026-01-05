<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-4">
                <x-user-avatar :user="$user"></x-user-avatar>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $user->name }}
                    </h2>
                    <p class="text-sm text-gray-600 flex items-center gap-1.5 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ $user->email }}
                    </p>
                </div>
            </div>

            <x-edit-button href="{{ route('admin.users.edit', $user) }}">
                Edit User
            </x-edit-button>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6 lg:p-8 space-y-8">

            @if(session('success'))
                <x-success-toast></x-success-toast>
            @endif

            <div class="max-w-7xl mx-auto space-y-8">

                {{-- User Stats --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <x-admin-stat name="Topics">
                        {{ $user->topics_count }}
                    </x-admin-stat>

                    <x-admin-stat name="Replies">
                        {{ $user->replies_count }}
                    </x-admin-stat>

                    <x-admin-stat name="Bookmarks">
                        {{ $user->bookmarks_count }}
                    </x-admin-stat>
                </div>

                {{-- Topics Table --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">
                            Topics
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @forelse($topics as $topic)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('topics.show', $topic) }}" class="group">
                                            <h4 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                                {{ $topic->title }}
                                            </h4>
                                        </a>
                                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                            <a href="{{ route('admin.categories.show', $topic->category) }}" class="flex items-center gap-1 hover:text-indigo-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                                <span class="font-medium">{{ $topic->category->name ?? '—' }}</span>
                                            </a>
                                            <span class="text-gray-300">•</span>
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                <span class="font-medium text-blue-700">{{ $topic->replies_count ?? 0 }}</span>
                                            </div>
                                            <span class="text-gray-300">•</span>
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $topic->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <x-danger-button
                                        x-data
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-topic-deletion-{{ $topic->id }}')">
                                        Delete
                                    </x-danger-button>
                                    <x-modal name="confirm-topic-deletion-{{ $topic->id }}" focusable>
                                        <form method="POST" action="{{ route('topics.destroy', $topic) }}" class="p-6 text-left">
                                            @csrf
                                            @method('DELETE')

                                            <h2 class="text-lg font-semibold text-gray-900">
                                                Delete topic?
                                            </h2>

                                            <p class="mt-2 text-sm text-gray-600">
                                                This will permanently delete the topic and all its replies.
                                            </p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    Cancel
                                                </x-secondary-button>

                                                <x-danger-button>
                                                    Delete
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <p class="mt-2 text-sm">No topics created.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($topics->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $topics->links() }}
                        </div>
                    @endif
                </div>

                {{-- Replies Table --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">
                            Replies
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @forelse($replies as $reply)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-700 line-clamp-2 leading-relaxed">
                                            {{ Str::limit($reply->description, 150) }}
                                        </p>
                                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                            <span>replied to</span>
                                            <a href="{{ route('topics.show', $reply->topic) }}" class="font-semibold text-indigo-600 hover:text-indigo-700 line-clamp-1">
                                                {{ $reply->topic->title }}
                                            </a>
                                            <span class="text-gray-300">•</span>
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <x-danger-button
                                        x-data
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-reply-deletion-{{ $reply->id }}')">
                                        Delete
                                    </x-danger-button>
                                    <x-modal name="confirm-reply-deletion-{{ $reply->id }}" focusable>
                                        <form method="POST" action="{{ route('replies.destroy', $reply) }}" class="p-6 text-left">
                                            @csrf
                                            @method('DELETE')

                                            <h2 class="text-lg font-semibold text-gray-900">
                                                Delete reply?
                                            </h2>

                                            <p class="mt-2 text-sm text-gray-600">
                                                This will permanently delete the reply.
                                            </p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    Cancel
                                                </x-secondary-button>

                                                <x-danger-button>
                                                    Delete
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="mt-2 text-sm">No replies yet.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($replies->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $replies->links() }}
                        </div>
                    @endif
                </div>

                {{-- Bookmarks Table --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">
                            Bookmarked Topics
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @forelse($bookmarks as $bookmark)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('topics.show', $bookmark->topic) }}" class="group">
                                            <h4 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1">
                                                {{ $bookmark->topic->title }}
                                            </h4>
                                        </a>
                                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                            <a href="{{ route('admin.categories.show', $bookmark->topic->category) }}" class="flex items-center gap-1 hover:text-indigo-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                                <span class="font-medium">{{ $bookmark->topic->category->name ?? '—' }}</span>
                                            </a>
                                            <span class="text-gray-300">•</span>
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Bookmarked {{ $bookmark->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('bookmarks.toggle') }}">
                                        @csrf
                                        <input type="hidden" name="topic_id" value="{{ $bookmark->topic->id }}">
                                        <button type="submit" title="Remove bookmark" class="transform hover:scale-110 transition-all duration-200 text-2xl p-1 rounded-full hover:bg-red-50 text-red-500">
                                            ❤️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <p class="mt-2 text-sm">No bookmarks yet.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($bookmarks->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $bookmarks->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>
</x-app-layout>

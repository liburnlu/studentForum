<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ $user->name }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $user->email }}
                </p>
            </div>

            <x-edit-button href="{{ route('admin.users.edit', $user) }}">
                Edit User
            </x-edit-button>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6 space-y-8">
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
                <div class="bg-white rounded-xl border shadow-sm">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Topics
                        </h3>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Category</th>
                            <th class="px-6 py-3 text-left">Replies</th>
                            <th class="px-6 py-3 text-left">Created</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y">
                        @forelse($topics as $topic)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <a href="{{ route('topics.show', $topic) }}"
                                       class="hover:underline">
                                        {{ $topic->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <a href="{{route('admin.categories.show' , $topic->category)}}"
                                    class="hover:underline">
                                    {{ $topic->category->name ?? '—' }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $topic->replies_count ?? 0 }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $topic->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <x-danger-button
                                        x-data
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-topic-deletion-{{ $topic->id }}')">
                                        Delete
                                    </x-danger-button>
                                    <x-modal name="confirm-topic-deletion-{{ $topic->id }}" focusable>
                                        <form method="POST"
                                              action="{{ route('topics.destroy', $topic) }}"
                                              class="p-6 text-left">
                                            @csrf
                                            @method('DELETE')

                                            <h2 class="text-lg font-semibold text-gray-900">
                                                Delete topic?
                                            </h2>

                                            <p class="mt-2 text-sm text-gray-600">
                                                This will permanently delete the topic and all its replies.
                                            </p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button
                                                    x-on:click="$dispatch('close')">
                                                    Cancel
                                                </x-secondary-button>

                                                <x-danger-button>
                                                    Delete
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    No topics created.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $topics->links() }}
                    </div>
                </div>

                {{-- Replies Table --}}
                <div class="bg-white rounded-xl border shadow-sm">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Replies
                        </h3>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Reply</th>
                            <th class="px-6 py-3 text-left">Topic</th>
                            <th class="px-6 py-3 text-left">Created</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y">
                        @forelse($replies as $reply)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-900 line-clamp-1">
                                    {{ Str::limit($reply->description, 60) }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <a href="{{ route('topics.show', $reply->topic) }}"
                                       class="hover:underline">
                                        {{ $reply->topic->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $reply->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <x-danger-button
                                        x-data
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-reply-deletion-{{ $reply->id }}')">
                                        Delete
                                    </x-danger-button>
                                    <x-modal name="confirm-reply-deletion-{{ $reply->id }}" focusable>
                                        <form method="POST"
                                              action="{{ route('replies.destroy', $reply) }}"
                                              class="p-6 text-left">
                                            @csrf
                                            @method('DELETE')

                                            <h2 class="text-lg font-semibold text-gray-900">
                                                Delete reply?
                                            </h2>

                                            <p class="mt-2 text-sm text-gray-600">
                                                This will permanently delete the reply.
                                            </p>

                                            <div class="mt-6 flex justify-end gap-3">
                                                <x-secondary-button
                                                    x-on:click="$dispatch('close')">
                                                    Cancel
                                                </x-secondary-button>

                                                <x-danger-button>
                                                    Delete
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                                    No replies yet.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $replies->links() }}
                    </div>
                </div>

                {{-- Bookmarks Table --}}
                <div class="bg-white rounded-xl border shadow-sm">
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Bookmarked Topics
                        </h3>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Category</th>
                            <th class="px-6 py-3 text-left">Bookmarked</th>
                            <th class="px-6 py-3 text-right">Actions</th>

                        </tr>
                        </thead>
                        <tbody class="divide-y">
                        @forelse($bookmarks as $bookmark)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <a href="{{ route('topics.show', $bookmark->topic) }}"
                                       class="hover:underline">
                                        {{ $bookmark->topic->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <a href="{{route('admin.categories.show' , $bookmark->topic->category)}}"
                                    class="hover:underline">
                                    {{ $bookmark->topic->category->name ?? '—' }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $bookmark->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('bookmarks.toggle') }}">
                                        @csrf

                                        <input type="hidden" name="topic_id" value="{{ $bookmark->topic->id }}">

                                        <button type="submit"
                                                title="Remove bookmark"
                                                class="group transition">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="currentColor"
                                                 viewBox="0 0 24 24"
                                                 class="w-5 h-5 text-red-500 group-hover:scale-110 transition">
                                                <path d="M12 21s-6.716-4.418-9.428-7.143C-1.19 10.29 1.01 4.5 6.225 4.5c2.215 0 3.775 1.45 4.775 2.757C12 5.95 13.56 4.5 15.775 4.5c5.215 0 7.415 5.79 3.653 9.357C18.716 16.582 12 21 12 21z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>



                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                                    No bookmarks yet.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="p-4">
                        {{ $bookmarks->links() }}
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>

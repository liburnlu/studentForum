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

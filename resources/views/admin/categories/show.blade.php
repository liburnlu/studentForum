<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $category->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Topics in this category
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex bg-gray-100 min-h-screen">
        {{-- Admin Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto space-y-6">

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Table Header --}}
                    <div class="px-6 py-4 border-b flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Topics in "<i>{{ $category->name }}"</i>
                        </h3>
                        <p class="text-xs text-gray-400 italic">
                            Total: {{ $topics->total() }}
                        </p>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Topic
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Author
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Replies
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    Views
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                    Created
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($topics as $topic)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Topic --}}
                                    <td class="px-6 py-4">
                                        <a
                                            href="{{ route('topics.show', $topic) }}"
                                            class="font-medium text-gray-900 hover:text-indigo-600"
                                        >
                                            {{ $topic->title }}
                                        </a>

                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                            {{ Str::limit($topic->description, 100) }}
                                        </p>
                                    </td>

                                    {{-- Author --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <a href="{{route('admin.users.show' , $topic->user)}}"
                                        class="hover:underline">
                                        {{ $topic->user->name }}
                                        </a>
                                    </td>

                                    {{-- Replies --}}
                                    <td class="px-6 py-4 text-center text-sm text-gray-700">
                                        {{ $topic->replies_count }}
                                    </td>

                                    {{-- Views --}}
                                    <td class="px-6 py-4 text-center text-sm text-gray-700">
                                        {{ $topic->views }}
                                    </td>

                                    {{-- Created --}}
                                    <td class="px-6 py-4 text-right text-sm text-gray-500">
                                        {{ $topic->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                        No topics in this category yet.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div>
                    {{ $topics->withQueryString()->links() }}
                </div>

            </div>
        </main>
    </div>
</x-app-layout>

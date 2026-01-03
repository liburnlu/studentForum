<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $category->name }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ $topics->total() }}</span> topics in this category
                </p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold transition-colors">
                ← Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="flex bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        {{-- Admin Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Table Header --}}
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                        <div class="grid grid-cols-12 gap-4 items-center font-semibold text-sm text-indigo-900">
                            <div class="col-span-5">Topic</div>
                            <div class="col-span-2">Author</div>
                            <div class="col-span-2 text-center">Stats</div>
                            <div class="col-span-3 text-right">Created</div>
                        </div>
                    </div>

                    {{-- Table Body --}}
                    <div class="divide-y divide-gray-200">
                        @forelse($topics as $topic)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    {{-- Topic Column --}}
                                    <div class="col-span-5">
                                        <a href="{{ route('topics.show', $topic) }}" class="group">
                                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1 mb-1">
                                                {{ $topic->title }}
                                            </h3>
                                            <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                                {{ Str::limit($topic->description, 120) }}
                                            </p>
                                        </a>
                                    </div>

                                    {{-- Author Column --}}
                                    <div class="col-span-2">
                                        <a href="{{ route('admin.users.show', $topic->user) }}" class="group flex items-center gap-2">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-indigo-50">
                                                {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-sm text-gray-700 group-hover:text-indigo-600 transition-colors">
                                                {{ $topic->user->name }}
                                            </span>
                                        </a>
                                    </div>

                                    {{-- Stats Column --}}
                                    <div class="col-span-2">
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex items-center justify-center gap-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                <span class="font-semibold text-blue-700">{{ $topic->replies_count }}</span>
                                                <span class="text-gray-600">replies</span>
                                            </div>
                                            <div class="flex items-center justify-center gap-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span class="font-semibold text-purple-700">{{ $topic->views }}</span>
                                                <span class="text-gray-600">views</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Created Column --}}
                                    <div class="col-span-3 text-right">
                                        <div class="flex items-center justify-end gap-1.5 text-xs text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $topic->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-900">No topics yet</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    No topics have been created in this category yet.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Pagination --}}
                @if($topics->hasPages())
                    <div class="mt-6">
                        {{ $topics->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</x-app-layout>

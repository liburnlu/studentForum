<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Categories
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ $categories->count() }}</span> categories
                </p>
            </div>

            <x-button-link href="{{ route('admin.categories.create') }}">
                Create Category
            </x-button-link>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6 lg:p-8">

            @if(session('success'))
                <x-success-toast></x-success-toast>
            @endif

            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Table Header --}}
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                        <div class="grid grid-cols-12 gap-4 items-center font-semibold text-sm text-indigo-900">
                            <div class="col-span-5">Category Name</div>
                            <div class="col-span-2 text-center">Topics</div>
                            <div class="col-span-2">Created</div>
                            <div class="col-span-3 text-right">Actions</div>
                        </div>
                    </div>

                    {{-- Table Body --}}
                    <div class="divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    {{-- Name Column --}}
                                    <div class="col-span-5">
                                        <a href="{{ route('admin.categories.show', $category) }}"
                                           class="group">
                                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                                {{ $category->name }}
                                            </h3>
                                        </a>
                                    </div>

                                    {{-- Topics Column --}}
                                    <div class="col-span-2 text-center">
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                            <span class="font-semibold text-blue-700 text-sm">{{ $category->topics_count ?? 0 }}</span>
                                        </div>
                                    </div>

                                    {{-- Created Column --}}
                                    <div class="col-span-2">
                                        <div class="flex items-center gap-1.5 text-xs text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $category->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    {{-- Actions Column --}}
                                    <div class="col-span-3 flex justify-end gap-2">
                                        <x-edit-button
                                            href="{{ route('admin.categories.edit', $category) }}">
                                            Edit
                                        </x-edit-button>

                                        <x-danger-button
                                            x-data
                                            x-on:click="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')">
                                            Delete
                                        </x-danger-button>

                                        {{-- Delete Modal --}}
                                        <x-modal name="confirm-category-deletion-{{ $category->id }}" focusable>
                                            <form method="post" action="{{ route('admin.categories.destroy' , $category) }}" class="p-6 text-left">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete this category?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('This action will permanently delete the category and all of its topics and replies.') }}
                                                </p>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete Category') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-900">No categories yet</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Create your first category to organize forum topics.
                                </p>
                                <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-semibold">
                                    Create Category
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                Categories
            </h2>

            <x-button-link href="{{ route('admin.categories.create') }}">
                Create Category
            </x-button-link>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">

                <div class="bg-white shadow-sm rounded-xl border border-gray-200">
                    {{-- Header --}}
                    <div class="p-6 border-b flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Categories List
                        </h3>
                        <p class="text-xs text-gray-400 italic">
                            Total Categories: {{ $categories->count() }}
                        </p>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Topics
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Name --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.categories.show', $category) }}"
                                           class="hover:underline">
                                            {{ $category->name }}
                                        </a>
                                    </td>

                                    {{-- Topics --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $category->topics_count ?? 0 }}
                                    </td>

                                    {{-- Created --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->created_at->diffForHumans() }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right flex justify-end gap-2">
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-4 text-center text-sm text-gray-500">
                                        No categories yet.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>

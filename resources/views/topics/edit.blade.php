<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Topic
        </h2>
    </x-slot>

    <div class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6">
            <form method="POST" action="/topics/{{$topic->id}}" class="space-y-6 rounded-xl border border-gray-200 bg-white p-8 shadow-lg">
                @csrf
                @method('PATCH')

                <input type="hidden" name="redirect" value="{{ request()->query('redirect') }}">


                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                        Topic Title
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $topic->title) }}"
                        required
                        placeholder="Enter a descriptive title for your topic"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-sm transition-colors"
                    >
                    @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-2">
                        Category
                    </label>
                    <select
                        name="category_id"
                        id="category_id"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-sm transition-colors"
                    >
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $topic->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">
                        Topic Content
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="8"
                        required
                        placeholder="Share your thoughts, questions, or ideas in detail..."
                        class="w-full resize-none rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-sm transition-colors"
                    >{{ old('description', $topic->description) }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-4 items-center pt-4 border-t border-gray-100">
                    <a href="{{ route('topics.show', $topic) }}"
                       class="px-6 py-2.5 text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-lg border border-indigo-600 bg-indigo-600 px-8 py-2.5 text-sm font-semibold text-white transition-all hover:bg-indigo-700 hover:shadow-md">
                        Update Topic
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

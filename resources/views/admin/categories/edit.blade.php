<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 px-6 pb-10">
        <form method="POST" action="/admin/categories/{{$category->id}}" class="space-y-6">
            @csrf
            @method('PATCH')
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">
                    Name
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name' , $category->name) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Content -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Description
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="6"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >{{ old('description' , $category->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 items-center ">
                <a  href="{{ route('admin.categories.index') }}">
                    <x-secondary-button
                    >
                        Cancel
                    </x-secondary-button>
                </a>
                <x-primary-button class="bg-indigo-600">Edit Category</x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>

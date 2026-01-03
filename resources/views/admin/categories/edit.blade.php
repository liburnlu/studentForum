<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Update Category
        </h2>
    </x-slot>

    <div class="flex h-screen bg-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-center">
                    <div class="w-full max-w-xl">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

                            {{-- Card Header --}}
                            <div class="border-b px-6 py-4">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Category Information
                                </h3>
                            </div>

                            {{-- Form --}}
                            <form
                                method="POST"
                                action="{{route('admin.categories.update' , $category)}}"
                                class="p-6 space-y-5"
                            >
                                @csrf
                                @method('PATCH')

                                {{-- Name --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">
                                        Name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{old('name' , $category->name)}}"
                                        class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
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

                                {{-- Actions --}}
                                <div class="flex justify-end gap-3 pt-4 border-t">


                                    <a  href="{{ route('admin.users.index') }}">
                                        <x-secondary-button
                                        >
                                            Cancel
                                        </x-secondary-button>
                                    </a>

                                    <x-primary-button>
                                        Save Changes
                                    </x-primary-button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</x-app-layout>

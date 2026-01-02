<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800">
                Edit User
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
                                    User Details
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Update basic user information and role
                                </p>
                            </div>

                            {{-- Form --}}
                            <form
                                method="POST"
                                action="{{ route('admin.users.update', $user) }}"
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
                                        value="{{ old('name', $user->name) }}"
                                        class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                {{-- Role --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">
                                        Role
                                    </label>

                                    <select
                                        name="role"
                                        class="mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option value="student" @selected($user->role === 'student')>
                                            Student
                                        </option>
                                        <option value="admin" @selected($user->role === 'admin')>
                                            Admin
                                        </option>
                                    </select>
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

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Users
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    All registered users
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex bg-gray-50 min-h-screen">
        {{-- Admin Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            <div class="max-w-7xl mx-auto space-y-6">

                <div class="bg-white shadow-sm rounded-xl border border-gray-200">
                    <div class="p-6 border-b flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-700">
                            Users List
                        </h3>
                        <p class="text-xs text-gray-400 italic">
                            Total Users: {{ $users->total() }}
                        </p>
                    </div>

                    {{-- Users Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{route('admin.users.show' , $user)}}">
                                            {{ $user->name }}
                                            </a>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->role ?? 'student' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                        <x-edit-button href="{{route('admin.users.edit' , $user)}}">
                                            Edit
                                        </x-edit-button>

                                        <x-danger-button
                                            x-data
                                            x-on:click="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')">
                                            Delete
                                        </x-danger-button>

                                        <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                                            <form method="post" action="{{ route('admin.users.destroy' , $user) }}" class="p-6 text-left    ">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete this user?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('This action will permanently delete the user.') }}
                                                </p>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete User') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="p-6">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>

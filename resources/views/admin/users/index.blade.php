<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Users
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ $users->total() }}</span> registered users
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
        {{-- Admin Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 lg:p-8">

            @if(session('success'))
                <x-success-toast></x-success-toast>
            @endif

                <!-- Search Bar -->
                <x-search-bar name="Search users..." route="admin.users.index"></x-search-bar>


            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Table Header --}}
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                        <div class="grid grid-cols-12 gap-4 items-center font-semibold text-sm text-indigo-900">
                            <div class="col-span-4">User</div>
                            <div class="col-span-3">Email</div>
                            <div class="col-span-2">Role</div>
                            <div class="col-span-3 text-right">Actions</div>
                        </div>
                    </div>

                    {{-- Table Body --}}
                    <div class="divide-y divide-gray-200">
                        @forelse($users as $user)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    {{-- User Column --}}
                                    <div class="col-span-4">
                                        <a href="{{ route('admin.users.show', $user) }}"
                                           class="group flex items-center gap-3">

                                            <x-user-avatar :user="$user" size="sm"></x-user-avatar>

                                            <span
                                                class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                                {{ $user->name }}
                                            </span>
                                        </a>
                                    </div>

                                    {{-- Email Column --}}
                                    <div class="col-span-3">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="truncate">{{ $user->email }}</span>
                                        </div>
                                    </div>

                                    {{-- Role Column --}}
                                    <div class="col-span-2">
                                        @if(($user->role ?? 'student') === 'admin')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-gradient-to-r from-indigo-50 to-indigo-100 text-xs font-bold text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                                Admin
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-xs font-semibold text-gray-700">
                                                Student
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Actions Column --}}
                                    <div class="col-span-3 flex justify-end gap-2">
                                        <x-edit-button href="{{ route('admin.users.edit', $user) }}">
                                            Edit
                                        </x-edit-button>

                                        <x-danger-button
                                            x-data
                                            x-on:click="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')">
                                            Delete
                                        </x-danger-button>

                                        <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                                            <form method="post" action="{{ route('admin.users.destroy', $user) }}"
                                                  class="p-6 text-left">
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
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="mt-2 text-sm font-medium text-gray-900">No users found</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    No users are registered yet.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($users->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

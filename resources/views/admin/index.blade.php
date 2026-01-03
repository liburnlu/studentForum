<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Panel') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        @include('layouts.admin-sidebar')

        {{-- Main content --}}
        <main class="flex-1 p-6">
            {{-- Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
                <x-admin-stat name="Users">{{ $stats['users'] ?? 0 }}</x-admin-stat>
                <x-admin-stat name="Topics">{{ $stats['topics'] ?? 0 }}</x-admin-stat>
                <x-admin-stat name="Replies">{{ $stats['replies'] ?? 0 }}</x-admin-stat>
                <x-admin-stat name="Categories">{{ $stats['categories'] ?? 0 }}</x-admin-stat>
            </div>


            {{-- Management Sections --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <a href="{{ route('admin.users.index') }}"
                   class="group bg-white rounded-xl border p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">
                        Manage Users
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        View, ban, or moderate users
                    </p>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="group bg-white rounded-xl border p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">
                        Manage Categories
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Create and organize forum categories
                    </p>
                </a>

                <!--
                <a href="/"
                   class="group bg-white rounded-xl border p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">
                        Manage Topics
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Moderate or remove problematic topics
                    </p>
                </a>

                <a href="/"
                   class="group bg-white rounded-xl border p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-indigo-600">
                        Manage Replies
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Review reported or flagged replies
                    </p>
                </a>
            </div>
            -->

        </main>
    </div>
</x-app-layout>

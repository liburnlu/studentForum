<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <!-- Brand -->
    <div class="h-16 flex items-center px-6 border-b">
        <span class="text-lg font-bold text-indigo-600">
            Admin Panel
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('admin') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('admin') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('admin.users*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Users
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
           {{ request()->routeIs('admin.categories*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Categories
        </a>

    </nav>
</aside>

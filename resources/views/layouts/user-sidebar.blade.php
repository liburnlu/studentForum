<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    <!-- Brand / Header -->
    <div class="h-16 flex items-center px-6 border-b ">
        <a href="{{ route('dashboard') }}">
        <span class="text-lg font-bold text-indigo-600">
            Dashboard
        </span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">

        <!-- Profile -->
        <a href="/profile"
           class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
           {{ request()->is('profile') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100' }}">
            Profile
        </a>

        <!-- My Content Dropdown -->
        <details class="group">
            <summary
                class="flex cursor-pointer items-center justify-between gap-3 px-4 py-2 rounded-lg text-sm font-medium
                text-gray-600 hover:bg-gray-100">
                <span>My Content</span>

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="size-4 transition group-open:rotate-180"
                     viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </summary>

            <div class="mt-1 ml-4 space-y-1">
                <a href="/dashboard/topics"
                   class="block px-4 py-2 rounded-lg text-sm
                   {{ request()->is('dashboard/topics')
                       ? 'bg-indigo-50 text-indigo-700'
                       : 'text-gray-600 hover:bg-gray-100' }}">
                    My Topics
                </a>

                <a href="/dashboard/replies"
                   class="block px-4 py-2 rounded-lg text-sm
                   {{ request()->is('dashboard/replies')
                       ? 'bg-indigo-50 text-indigo-700'
                       : 'text-gray-600 hover:bg-gray-100' }}">
                    My Replies
                </a>
            </div>
        </details>

        <!-- Account Dropdown -->
        <details class="group">
            <summary
                class="flex cursor-pointer items-center justify-between gap-3 px-4 py-2 rounded-lg text-sm font-medium
                text-gray-600 hover:bg-gray-100">
                <span>Account</span>

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="size-4 transition group-open:rotate-180"
                     viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </summary>

            <div class="mt-1 ml-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full text-left px-4 py-2 rounded-lg text-sm
                        text-gray-600 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </details>

    </nav>

    <!-- User Info -->
    <div class="sticky bottom-0 border-t border-gray-200 p-4">
        <div class="flex items-center gap-3">
            <x-user-avatar :user="auth()->user()"></x-user-avatar>


            <div class="text-sm">
                <p class="font-medium text-gray-800">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>
    </div>
</aside>

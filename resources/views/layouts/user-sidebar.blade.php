<aside class="w-64 flex-shrink-0 border-e border-gray-100 bg-white flex flex-col justify-between">
    <div class="px-4 py-6">
        <ul class="mt-6 space-y-1">
            <li>
                <a href="/profile"
                   class="block rounded-lg hover:bg-gray-100 px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                    Profile
                </a>
            </li>

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="text-sm font-medium"> My Content </span>
                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                    </summary>
                    <ul class="mt-2 space-y-1 px-4">
                        <li>
                            <a href="/dashboard/topics"
                               class="block rounded-lg px-4 py-2 text-sm font-medium
                               {{ request()->is('dashboard/topics') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                                My Topics
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard/replies"
                               class="block rounded-lg px-4 py-2 text-sm font-medium
                               {{ request()->is('dashboard/replies') ? 'bg-gray-100 text-gray-700' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">
                                My Replies
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <span class="text-sm font-medium">Account</span>
                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                    </summary>
                    <ul class="mt-2 space-y-1 px-4">
                        <li>

                            <form method="POST" action="{{route('logout')}}">
                                @csrf

                                <button type="submit"
                                        class="w-full text-left block rounded-lg px-4 py-2 text-sm font-medium
                                         text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </details>
            </li>

        </ul>
    </div>

    <div class="sticky bottom-0 border-t border-gray-100 bg-white">
        <a href="/profile" class="flex items-center gap-2 p-4 hover:bg-gray-50">
            <img alt="" src="" class="size-10 rounded-full object-cover">
            <div>
                <p class="text-xs">
                    <strong class="block font-medium">{{auth()->user()->name}}</strong>
                    <span> {{auth()->user()->email}} </span>
                </p>
            </div>
        </a>
    </div>
</aside>

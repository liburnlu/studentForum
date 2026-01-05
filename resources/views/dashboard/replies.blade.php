<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ __('My Replies') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="font-semibold text-indigo-600">{{ $replies->total() }}</span> replies posted
                </p>
            </div>
        </div>
    </x-slot>

    <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Sidebar -->
        @include('layouts.user-sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6 lg:p-8">

            @if(session('success'))
                <x-success-toast></x-success-toast>
            @endif

                <!-- Search Bar -->
                <x-search-bar name="Search replies..." route="dashboard.replies"></x-search-bar>



                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <!-- Table Header -->
                        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 border-b border-indigo-200">
                            <div class="grid grid-cols-12 gap-4 items-center font-semibold text-sm text-indigo-900">
                                <div class="col-span-6">Reply</div>
                                <div class="col-span-3">Topic</div>
                                <div class="col-span-3 text-right">Actions</div>
                            </div>
                        </div>

                        <!-- Table Body -->
                        <div class="divide-y divide-gray-200">
                            @forelse($replies as $reply)
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                    <div class="grid grid-cols-12 gap-4 items-center">
                                        <!-- Reply Column -->
                                        <div class="col-span-6">
                                            <a href="{{ route('topics.show', $reply->topic) }}" class="group">
                                                <p class="text-sm text-gray-700 line-clamp-2 leading-relaxed group-hover:text-indigo-600 transition-colors">
                                                    {{ Str::limit($reply->description, 150) }}
                                                </p>
                                                <div class="flex items-center gap-2 text-xs text-gray-500 mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                         fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Topic Column -->
                                        <div class="col-span-3">
                                            <a href="{{ route('topics.show', $reply->topic) }}" class="group">
                                                <div class="flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4 text-indigo-500 flex-shrink-0" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                                    </svg>
                                                    <span
                                                        class="font-semibold text-sm text-indigo-600 group-hover:text-indigo-700 line-clamp-2 transition-colors">
                                                {{ $reply->topic->title }}
                                            </span>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- Actions Column -->
                                        <div class="col-span-3 flex justify-end gap-2">
                                            <x-edit-button
                                                href="{{route('replies.edit' , ['reply' => $reply , 'redirect' => 'dashboard'])}}">
                                                Edit
                                            </x-edit-button>

                                            <x-danger-button
                                                x-data=""
                                                x-on:click="$dispatch('open-modal', 'confirm-reply-deletion-{{ $reply->id }}')"
                                            >Delete
                                            </x-danger-button>

                                            <x-modal name="confirm-reply-deletion-{{ $reply->id }}" focusable>
                                                <form method="post" action="{{ route('replies.destroy' , $reply) }}"
                                                      class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Are you sure you want to delete this reply?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('This action will permanently delete this reply!') }}
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete Reply') }}
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
                                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-900">No replies yet</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Start engaging with the community by replying to topics.
                                    </p>
                                    <a href="{{ route('topics.index') }}"
                                       class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-semibold">
                                        Browse Topics
                                    </a>
                                </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        @if($replies->hasPages())
                            <div class="px-6 py-4 border-t border-gray-100">
                                {{ $replies->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>
        </main>
    </div>
</x-app-layout>

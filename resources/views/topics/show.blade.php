<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                {{$topic->title}}
            </h2>

            <x-button-link href="{{ route('topics.create') }}">
                Create Topic
            </x-button-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Topic Header Card -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="p-6 sm:p-8">
                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-800">
                            {{ $topic->category->name }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $topic->title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        <!-- Author -->
                        <div class="flex items-center">
                            <div
                                class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold mr-2">
                                {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                            </div>
                            <span>
                                Posted by
                                <span class="font-medium text-gray-900">{{ $topic->user->name }}</span>
                            </span>
                        </div>

                        <span class="text-gray-400">·</span>

                        <!-- Time -->
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $topic->created_at->diffForHumans() }}
                        </div>

                        <span class="text-gray-400">·</span>

                        <!-- Views -->
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ $topic->views }} {{ Str::plural('view', $topic->views) }}
                        </div>

                        <span class="text-gray-400">·</span>

                        <!-- Replies -->
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                            </svg>
                            {{ $topic->replies_count }} {{ Str::plural('reply', $topic->replies_count) }}
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Content -->
                    <div class="prose prose-indigo max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $topic->description }}</p>
                    </div>

                    <!-- Action Buttons -->


                    @if(auth()->user()->id === $topic->user_id)
                    <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200 ">


                        <x-edit-button href="{{route('topics.edit' , $topic)}}">
                            Edit Topic
                        </x-edit-button>


                        <x-danger-button
                            x-data=""
                            x-on:click="$dispatch('open-modal', 'confirm-topic-deletion-{{ $topic->id }}')"
                        >{{ __('Delete Topic') }}
                        </x-danger-button>

                        <x-modal name="confirm-topic-deletion-{{ $topic->id }}" focusable>
                            <form method="post" action="{{ route('topics.destroy' , $topic) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete this topic?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('This action will permanently delete the topic and all of its replies.') }}
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Topic') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                    @endif

                </div>
            </div>


            <!-- Replies Section -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">
                        {{ $topic->replies_count}} {{ Str::plural('Reply', $topic->replies_count) }}
                    </h2>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($replies as $reply)
                        <div class="p-6 hover:bg-gray-50 transition">
                            <!-- Reply Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <!-- User Avatar -->
                                    <div
                                        class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-semibold mr-3">
                                        {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $reply->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Reply Content -->
                            <div class="prose prose-sm max-w-none mb-4">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $reply->description }}</p>
                            </div>

                            <!-- Reply Actions -->
                            @auth
                                <div class="flex items-center gap-4 text-sm justify-end">
                                    @if(auth()->user()->id === $reply->user_id)

                                        <x-edit-button href="{{route('replies.edit' , $reply)}}">
                                            Edit
                                        </x-edit-button>

                                        <x-danger-button
                                            x-data=""
                                            x-on:click="$dispatch('open-modal', 'confirm-reply-deletion-{{ $reply->id }}')"
                                            class="px-2 py-1 font-medium "
                                        >{{ __('Delete') }}</x-danger-button>

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

                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endforeach
                    @if($replies->count() === 0)
                        <div class="p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No replies yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Be the first to reply to this topic.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Reply Form -->
            @auth
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Add a Reply</h3>
                    </div>
                    <form method="POST" action="{{route('replies.store' , $topic)}}" class="p-6">
                        @csrf

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Your
                                Reply</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('content') border-red-500 @enderror"
                                placeholder="Share your thoughts..."
                                required>{{ old('description') }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Post Reply
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <p class="text-gray-600 mb-4">Please log in to reply to this topic.</p>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 transition">
                        Log In to Reply
                    </a>
                </div>
            @endauth

            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('topics.index') }}"
                   class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to all topics
                </a>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</x-app-layout>

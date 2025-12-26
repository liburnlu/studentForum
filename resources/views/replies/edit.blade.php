<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Reply
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 px-6">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('replies.update', $reply) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Reply -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Your Reply
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                        placeholder="Update your reply..."
                        required
                    >{{ old('description', $reply->description) }}</textarea>

                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center pt-4 border-t">
                    <a href="{{ url()->previous() }}"
                       class="text-sm text-gray-600 hover:text-gray-900">
                        Cancel
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-md text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 mr-2"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2z"/>
                        </svg>
                        Update Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

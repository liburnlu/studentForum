<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800">
                Forum Topics
            </h2>
        </div>
    </x-slot>


    <div class="bg-gradient-to-b from-gray-50 to-gray-100">

        <div class="min-h-screen flex items-center justify-center px-4 py-12">

            <div class="w-full max-w-2xl">

                @if(session('success'))
                    <x-success-toast></x-success-toast>
                @endif
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">Get in Touch</h1>
                    <p class="text-gray-600">Have a question or feedback? We'd love to hear from you.</p>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                    <form id="contactForm" class="space-y-6" method="POST" action="{{route('contact.store')}}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Your Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                                placeholder="John Doe"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                                placeholder="john@example.com"
                            >
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                                Subject
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                                placeholder="How can we help?"
                            >
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="body" class="block text-sm font-semibold text-gray-900 mb-2">
                                Message
                            </label>
                            <textarea
                                id="body"
                                name="body"
                                required
                                rows="5"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent resize-none"
                                placeholder="Tell us more about your inquiry..."
                            ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold"
                        >
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <!-- Email -->
                    <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                        <div class="flex justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <p class="text-gray-600 text-sm">support@example.com</p>
                    </div>

                    <!-- Phone -->
                    <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                        <div class="flex justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.609l2.01 1.242a1 1 0 001.187-.202c.28-.36.614-.695 1.035-1.116a1 1 0 011.591.243l1.047 1.587c.283.426.637.878 1.022 1.122a1 1 0 00.117 1.595l-2.01 1.242a1 1 0 00-.502.609l-1.498 4.493a1 1 0 00-.948.684H5a2 2 0 01-2-2V5z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                        <p class="text-gray-600 text-sm">+1 (555) 123-4567</p>
                    </div>

                    <!-- Address -->
                    <div class="bg-white rounded-lg shadow p-6 text-center border border-gray-200">
                        <div class="flex justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Location</h3>
                        <p class="text-gray-600 text-sm">123 Main Street, City, Country</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

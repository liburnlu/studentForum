<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Forum Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<section class="bg-white lg:min-h-screen lg:flex lg:items-center">
    <div class="mx-auto w-full max-w-7xl px-4 py-16 sm:px-6 sm:py-24 md:grid md:grid-cols-2 md:items-center md:gap-8 lg:px-8 lg:py-32">
        <!-- Left Column: Text Content -->
        <div class="max-w-prose text-left">
            <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                Connect, Learn, and
                <strong class="text-indigo-600">Collaborate</strong>
                with Fellow Students
            </h1>

            <p class="mt-4 text-base text-gray-700 sm:text-lg/relaxed">
                Join our student forum to discuss courses, share resources, ask questions,
                and collaborate on academic topics. Build your knowledge together.
            </p>

            <div class="mt-6 flex gap-4 sm:mt-8">
                <a class="inline-block rounded border border-indigo-600 bg-indigo-600 px-6 py-3 font-medium text-white shadow-sm transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   href="/register">
                    Get Started
                </a>

                <a class="inline-block rounded border border-gray-300 bg-white px-6 py-3 font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-400"
                   href="/login">
                    Sign In
                </a>
            </div>
        </div>

        <!-- Right Column: Image/Illustration -->
        <div class="hidden md:block">
            <img
                src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80"
                alt="Students collaborating"
                class="rounded-lg shadow-xl"
            />
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Why Join Our Forum?</h2>
            <p class="mt-4 text-gray-600">Everything you need for academic collaboration</p>
        </div>

        <!-- Browse Topics Button -->
        <div class="flex justify-center mb-12">
            <a href="/topics"
               class="inline-flex items-center gap-3 bg-indigo-600 text-white px-10 py-4 rounded-lg font-semibold text-lg shadow-lg hover:bg-indigo-700 hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
                Browse Forum Topics
                <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>

        <!-- Feature Cards -->
        <div class="grid gap-8 md:grid-cols-3">
            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl group cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-indigo-600 group-hover:rotate-6">
                    <svg class="w-6 h-6 text-indigo-600 transition-colors duration-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 transition-colors duration-300 group-hover:text-indigo-600">Course Discussions</h3>
                <p class="text-gray-600 transition-colors duration-300 group-hover:text-gray-700">Engage in meaningful discussions about your courses with classmates</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl group cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-indigo-600 group-hover:rotate-6">
                    <svg class="w-6 h-6 text-indigo-600 transition-colors duration-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 transition-colors duration-300 group-hover:text-indigo-600">Share Resources</h3>
                <p class="text-gray-600 transition-colors duration-300 group-hover:text-gray-700">Share and discover helpful study materials and resources</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl group cursor-pointer">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-indigo-600 group-hover:rotate-6">
                    <svg class="w-6 h-6 text-indigo-600 transition-colors duration-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 transition-colors duration-300 group-hover:text-indigo-600">Build Community</h3>
                <p class="text-gray-600 transition-colors duration-300 group-hover:text-gray-700">Connect with peers and build lasting academic relationships</p>
            </div>
        </div>
    </div>
</section>
</body>
</html>

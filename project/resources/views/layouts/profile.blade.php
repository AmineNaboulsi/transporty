<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Profile'))</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center md:items-start">
                <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                    <img class="h-24 w-24 rounded-full border-4 border-white" src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png  " alt="{{ Auth::user()->name ?? 'User' }}">
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white">{{ Auth::user()->name ?? 'User Name' }}</h1>
                    <p class="text-indigo-100">Member since {{ Auth::user()->created_at->format('F Y') ?? 'January 2023' }}</p>
                    <div class="mt-3 flex flex-wrap justify-center md:justify-start gap-2">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
</body>
</html>

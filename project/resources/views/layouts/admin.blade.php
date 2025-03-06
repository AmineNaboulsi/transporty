<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - Navette Booking System</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>


    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar backdrop (mobile) -->
        <div
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-gray-900 bg-opacity-50 lg:hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <!-- Sidebar -->
        <div
            x-cloak
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition-all duration-300 transform bg-gradient-to-br from-blue-700 to-indigo-800 shadow-xl lg:translate-x-0 lg:static lg:inset-0"
        >
            <!-- Sidebar header -->
            <div class="flex items-center justify-center h-16 p-4 border-b border-blue-800">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shuttle-van text-white text-2xl"></i>
                    <span class="text-xl font-bold text-white">Navette Admin</span>
                </div>
            </div>

            <!-- User info -->
            <div class="flex flex-col items-center mt-6 mb-6">
                <div class="relative w-20 h-20 overflow-hidden bg-gray-200 rounded-full">
                    <svg class="absolute w-20 h-20 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h5 class="mt-2 text-lg font-medium text-white">{{ Auth::user()->name }}</h5>
                <span class="text-sm font-medium text-blue-200">Administrator</span>
            </div>

            <!-- Sidebar navigation -->
            <nav class="px-4 mt-2 space-y-1">
                <div class="border-b border-blue-800 pb-2 mb-4">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Main</p>

                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-lg hover:bg-blue-600 group">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="border-b border-blue-800 pb-2 mb-4">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Administration</p>

                    <a href="{{ route('roles.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-lg hover:bg-blue-600">
                        <i class="fas fa-user-shield w-5 h-5 mr-3"></i>
                        <span>Manage Roles</span>
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-white transition-colors rounded-lg hover:bg-blue-600">
                            <div class="flex items-center">
                                <i class="fas fa-bus w-5 h-5 mr-3"></i>
                                <span>Manage Navettes</span>
                            </div>
                            <i :class="{'transform rotate-180': open}" class="fas fa-chevron-down transition-transform"></i>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="px-4 py-2 mt-1 space-y-1 rounded-lg bg-blue-800 bg-opacity-50">
                            <a href="{{ route('navettes.index') }}" class="flex items-center px-3 py-2 text-sm text-white transition-colors rounded-md hover:bg-blue-700">
                                <i class="fas fa-list-ul w-4 h-4 mr-2"></i>
                                <span>All Navettes</span>
                            </a>
                            <a href="{{ route('tags.index') }}" class="flex items-center px-3 py-2 text-sm text-white transition-colors rounded-md hover:bg-blue-700">
                                <i class="fas fa-tags w-4 h-4 mr-2"></i>
                                <span>Navette Tags</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-b border-blue-800 pb-2 mb-4">
                    <p class="text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Operations</p>

                    <a href="{{ route('booking.index') }}" class="flex items-center px-4 py-3 text-white transition-colors rounded-lg hover:bg-blue-600">
                        <i class="fas fa-calendar-check w-5 h-5 mr-3"></i>
                        <span>Bookings</span>
                    </a>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-white transition-colors rounded-lg hover:bg-red-600">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="sticky top-0 z-10 flex items-center justify-between h-16 px-6 py-4 bg-white shadow-md">
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = !sidebarOpen" class="block text-gray-500 lg:hidden focus:outline-none">
                    <i x-show="!sidebarOpen" class="fas fa-bars text-xl"></i>
                    <i x-show="sidebarOpen" class="fas fa-times text-xl"></i>
                </button>

                <!-- Search bar -->
                <div class="flex-1 max-w-md ml-6 mr-6 hidden md:block">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input class="w-full py-2 pl-10 pr-4 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Search...">
                    </div>
                </div>

                <!-- Right header content -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div x-data="{ notificationsOpen: false }" class="relative">
                        <button @click="notificationsOpen = !notificationsOpen" class="p-2 text-gray-500 transition-colors rounded-full hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Notifications dropdown -->
                        <div x-show="notificationsOpen"
                             @click.away="notificationsOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 z-50 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg">
                            <div class="py-2">
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                                    <p class="text-sm font-medium text-gray-900">New booking confirmed</p>
                                </a>
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                                    <p class="text-sm font-medium text-gray-900">System update completed</p>
                                </a>
                            </div>
                            <a href="#" class="block py-2 text-sm font-medium text-center text-blue-600 bg-gray-50 hover:bg-gray-100">
                                View all notifications
                            </a>
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div x-data="{ profileOpen: false }" class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center transition-colors rounded-full hover:bg-gray-100 focus:outline-none">
                            <div class="w-8 h-8 overflow-hidden rounded-full">
                                <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="ml-2 mr-1 text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>

                        <!-- Profile dropdown menu -->
                        <div x-show="profileOpen"
                             @click.away="profileOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 z-50 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user w-4 h-4 mr-2"></i>
                                    <span>Your Profile</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog w-4 h-4 mr-2"></i>
                                    <span>Settings</span>
                                </a>
                                <hr class="my-1 border-gray-200">
                                <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt w-4 h-4 mr-2"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container px-6 py-8 mx-auto">
                    <!-- Flash messages -->
                    @if (session('success'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 4000)"
                             class="relative px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-0 right-0 p-2">
                                <i class="fas fa-times text-green-700"></i>
                            </button>
                        </div>
                    @endif

                    @if (session('info'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 4000)"
                             class="relative px-4 py-3 mb-6 text-blue-700 bg-blue-100 border border-blue-400 rounded" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span>{{ session('info') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-0 right-0 p-2">
                                <i class="fas fa-times text-blue-700"></i>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 4000)"
                             class="relative px-4 py-3 mb-6 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-0 right-0 p-2">
                                <i class="fas fa-times text-red-700"></i>
                            </button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 4000)"
                             class="relative px-4 py-3 mb-6 text-yellow-700 bg-yellow-100 border border-yellow-400 rounded" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <span>{{ session('warning') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-0 right-0 p-2">
                                <i class="fas fa-times text-yellow-700"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Page content -->
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="px-6 py-4 bg-white border-t">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500">© 2025 Navette Booking System. All rights reserved.</span>
                    </div>
                    <div class="flex items-center mt-2 space-x-4 md:mt-0">
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Terms of Service</a>
                        <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Contact</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>

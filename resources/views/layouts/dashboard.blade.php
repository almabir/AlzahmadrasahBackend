<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 h-screen font-sans antialiased">

<div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true, darkMode: false, profileOpen: false, notificationOpen: false }">

<aside :class="{'w-64': sidebarOpen, 'w-16': !sidebarOpen}" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 transition-all duration-300 ease-in-out">
    <div class="p-4">
        <div class="flex items-center justify-between mb-4">
            <span class="text-lg font-semibold" x-show="sidebarOpen">Dashboard</span>
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <nav>
            @foreach(config('sidebar.menu') as $item)
                @if(!isset($item['roles']) || auth()->user()->hasAnyRole($item['roles']))
                    <div x-data="{ open: false }">
                        <a href="{{ $item['url'] }}" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 ease-in-out flex items-center" @if(isset($item['children'])) @click.prevent="open = !open" @endif>
                            <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                            </svg>
                            <span x-show="sidebarOpen">{{ $item['label'] }}</span>
                            @if(isset($item['children']))
                                <svg :class="{'transform rotate-180': open}" class="w-4 h-4 ml-auto text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            @endif
                        </a>
                        @if(isset($item['children']))
                            <div x-show="open" class="ml-6">
                                @foreach($item['children'] as $child)
                                    <a href="{{ $child['url'] }}" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 ease-in-out flex items-center">
                                        <span x-show="sidebarOpen">{{ $child['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </nav>
    </div>
</aside>
    <div class="flex-1 overflow-x-hidden overflow-y-auto">

        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">
            <div class="container mx-auto flex justify-between items-center">
                {{-- Top Menu Content --}}
                <div class="flex items-center space-x-4">
                    {{-- Left side links if needed --}}
                </div>

                <div class="flex items-center space-x-4">
                    {{-- Notifications --}}
                    <div class="relative">
                        <button @click="notificationOpen = !notificationOpen" class="focus:outline-none">
                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.16 6 8.388 6 11v3.158a2.032 2.032 0 01-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>
                        <div x-show="notificationOpen" @click.away="notificationOpen = false" class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Notification 1</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Notification 2</a>
                            </div>
                        </div>
                    </div>

                    {{-- User Profile --}}
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://via.placeholder.com/150" alt="User Avatar">
                        </button>
                        <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Logout</a>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Dark Mode Toggle --}}
                    <button @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark')" class="focus:outline-none">
    <template x-if="!darkMode">
        <svg class="w-6 h-6 text-gray-800 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
    </template>
    <template x-if="darkMode">
        <svg class="w-6 h-6 text-gray-800 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
    </template>
</button>
                    <!-- <button @click="darkMode = darkMode; document.documentElement.classList.toggle('dark')" class="focus:outline-none" class="btn btn-icon btn-light dark:hidden" data-theme-toggle="true" data-tooltip="#theme_mode_dark">
                    <i class="ki-outline ki-sun">hh
                    </i>
                    </button>
                    <button @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark')" class="focus:outline-none" class="btn btn-icon btn-light hidden dark:flex" data-theme-toggle="true" data-tooltip="#theme_mode_light">
                    <i class="ki-outline ki-moon">ff
                    </i>
                    </button>
                    <div class="tooltip" id="theme_mode_light">
                    Switch to Light mode
                    </div>
                    <div class="tooltip" id="theme_mode_dark">
                    Switch to Dark mode
                    </div> -->
                </div>
            </div>
        </header>

        <main class="p-4">
            @yield('content')
        </main>

        <footer class="bg-gray-200 dark:bg-gray-800 p-4 text-center">
            &copy; {{ date('Y') }} Zakat Faundation. All rights reserved.
        </footer>
        
    </div>
</div>
</body>
</html>
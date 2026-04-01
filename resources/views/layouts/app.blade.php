<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-gray-950">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow Pro') }}</title>

        <!-- Fonts: Inter & Outfit for a premium feel -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;700;900&display=swap" rel="stylesheet">

        <!-- Styles / scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3, .font-heading { font-family: 'Outfit', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
            .dark .glass { background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(10px); }
        </style>
    </head>
    <body class="h-full font-sans antialiased text-gray-900 dark:text-gray-100 overflow-hidden">
        <div x-data="{ sidebarOpen: false }" class="flex h-full overflow-hidden bg-gray-50 dark:bg-gray-950">
            
            <!-- Mobile Sidebar Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden backdrop-blur-sm transition-opacity"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0 shadow-2xl lg:shadow-none">
                <div class="flex flex-col h-full">
                    <!-- Sidebar Header (Logo) -->
                    <div class="flex items-center justify-between h-20 px-8 border-b border-gray-100 dark:border-gray-800">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                            <div class="p-2 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none group-hover:rotate-12 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-xl font-black tracking-tighter text-gray-900 dark:text-white uppercase font-heading">TaskFlow<span class="text-indigo-600">.</span></span>
                        </a>
                        <button @click="sidebarOpen = false" class="lg:hidden p-2 text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
                        <x-nav-link-premium :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="dashboard">
                            Vue d'ensemble
                        </x-nav-link-premium>
                        
                        <x-nav-link-premium :href="route('tasks.index')" :active="request()->routeIs('tasks.*')" icon="tasks">
                            Mes Tâches
                        </x-nav-link-premium>

                        <div class="pt-8 pb-2 px-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Paramètres</div>
                        
                        <x-nav-link-premium :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="profile">
                            Mon Compte
                        </x-nav-link-premium>
                    </nav>

                    <!-- User Profile Bottom -->
                    <div class="p-6 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black shadow-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-xs font-bold text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 flex flex-col h-full relative overflow-hidden">
                
                <!-- Top Header -->
                <header class="h-20 glass border-b border-gray-100 dark:border-gray-800 flex items-center justify-between px-8 z-30 sticky top-0">
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 bg-gray-100 dark:bg-gray-800 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        <div>
                            @isset($header)
                                {{ $header }}
                            @endisset
                        </div>
                    </div>

                    <!-- Top Right Actions -->
                    <div class="flex items-center space-x-4">
                        <button class="p-2.5 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-xl transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>
                    </div>
                </header>

                <!-- Page Content -->
                <section class="flex-1 overflow-y-auto p-4 md:p-8">
                    {{ $slot }}
                </section>
                
                <!-- Toast Notifications -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:enter="translate-y-full" x-transition:leave="translate-y-full" class="fixed bottom-8 right-8 z-[100] flex items-center p-4 pr-12 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl shadow-2xl pointer-events-auto transition-transform duration-500">
                        <div class="p-2 bg-emerald-500 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-black uppercase tracking-widest opacity-50">Succès</span>
                            <span class="font-bold">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="absolute top-2 right-2 p-1 opacity-20 hover:opacity-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
            </main>
        </div>
    </body>
</html>

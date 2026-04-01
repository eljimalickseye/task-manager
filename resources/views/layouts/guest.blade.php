<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="h-full antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-gray-950 relative overflow-hidden">
            
            <!-- Animated Background Elements -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-700"></div>

            <div class="z-10 w-full px-6 flex flex-col items-center">
                <div class="mb-8 transform hover:scale-110 transition-transform duration-500">
                    <a href="/" class="flex items-center flex-col space-y-2">
                        <div class="p-4 bg-indigo-600 rounded-[2rem] shadow-2xl shadow-indigo-200 dark:shadow-none">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="text-3xl font-black tracking-tighter text-gray-900 dark:text-white uppercase font-heading">TaskFlow<span class="text-indigo-600">.</span></span>
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white dark:bg-gray-900 shadow-[0_35px_60px_-15px_rgba(0,0,0,0.1)] dark:shadow-none border border-gray-100 dark:border-gray-800 overflow-hidden sm:rounded-[2.5rem] relative">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-sm text-gray-400 font-medium">© {{ date('Y') }} TaskFlow Pro — Prêt pour le déploiement.</p>
            </div>
        </div>
    </body>
</html>

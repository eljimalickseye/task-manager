<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🚀 Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <!-- Statistics Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Tasks -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 dark:bg-indigo-900/30 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <div class="p-3 bg-indigo-600 rounded-2xl w-fit mb-6 shadow-lg shadow-indigo-100 dark:shadow-none">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Tâches</span>
                    <span class="text-4xl font-black text-gray-900 dark:text-white font-heading">{{ $stats['total'] }}</span>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 dark:bg-amber-900/30 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <div class="p-3 bg-amber-500 rounded-2xl w-fit mb-6 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">En attente</span>
                    <span class="text-4xl font-black text-gray-900 dark:text-white font-heading">{{ $stats['pending'] }}</span>
                </div>
            </div>

            <!-- Urgent (High Priority) -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 dark:bg-rose-900/30 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <div class="p-3 bg-rose-600 rounded-2xl w-fit mb-6 shadow-lg shadow-rose-100">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Urgences 🔥</span>
                    <span class="text-4xl font-black text-gray-900 dark:text-white font-heading">{{ $stats['urgent'] }}</span>
                </div>
            </div>

            <!-- Completed -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 dark:bg-emerald-900/30 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <div class="p-3 bg-emerald-500 rounded-2xl w-fit mb-6 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Terminées 🎯</span>
                    <span class="text-4xl font-black text-gray-900 dark:text-white font-heading">{{ $stats['completed'] }}</span>
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="bg-indigo-600 p-12 rounded-[40px] shadow-3xl overflow-hidden relative group">
            <div class="absolute right-0 top-0 w-1/3 h-full bg-white opacity-[0.05] -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                <div class="text-center md:text-left mb-8 md:mb-0">
                    <h3 class="text-4xl font-black text-white mb-4">Bienvenue, {{ explode(' ', Auth::user()->name)[0] }} ! ✨</h3>
                    <p class="text-indigo-100 text-lg max-w-xl font-medium">Vous avez <span class="font-black underline">{{ $stats['pending'] }} tâches en attente</span>. C'est le moment idéal pour booster votre productivité.</p>
                </div>
                <a href="{{ route('tasks.index') }}" class="px-10 py-5 bg-white text-indigo-600 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-110 active:scale-95 transition-all shadow-2xl">
                    Voir mes tâches
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

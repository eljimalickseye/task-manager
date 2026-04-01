<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🚀 Dashboard Analytique') }}
        </h2>
    </x-slot>

    <div class="py-6 space-y-8">
        <!-- 📊 Widgets Statistiques & Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Statistiques à gauche (2/3) -->
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Total Tasks -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-indigo-50 dark:bg-indigo-900/20 rounded-full group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="p-3 bg-indigo-600 rounded-2xl w-fit mb-6 shadow-xl shadow-indigo-100 dark:shadow-none">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 font-heading">Total Objectifs</span>
                        <span class="text-5xl font-black text-gray-900 dark:text-white font-heading">{{ $stats['total'] }}</span>
                    </div>
                </div>

                <!-- Urgent Tasks -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                    <div class="absolute -right-6 -top-6 w-32 h-32 bg-rose-50 dark:bg-rose-900/20 rounded-full group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="p-3 bg-rose-600 rounded-2xl w-fit mb-6 shadow-xl shadow-rose-100 dark:shadow-none">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-2 font-heading">Tâches Urgentes</span>
                        <span class="text-5xl font-black text-rose-600 dark:text-rose-400 font-heading">{{ $stats['urgent'] }}</span>
                    </div>
                </div>

                <!-- Banner Section spanning 2 columns -->
                <div class="md:col-span-2 bg-gradient-to-br from-indigo-600 to-purple-700 p-10 rounded-[2rem] shadow-2xl relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-1/2 h-full bg-white opacity-[0.05] -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="relative z-10">
                        <h3 class="text-3xl font-black text-white mb-4">Hello, {{ explode(' ', Auth::user()->name)[0] }} ! ✨</h3>
                        <p class="text-indigo-100 text-lg max-w-xl font-medium mb-8">
                            Votre focus aujourd'hui : <span class="font-black underline">{{ $stats['pending'] }} tâches en attente</span>.
                            Prêt à augmenter votre score de productivité ?
                        </p>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-10 py-5 bg-white text-indigo-600 rounded-2xl font-black text-sm uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-2xl">
                            Accéder à ma liste
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4 4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Graphique à droite (1/3) -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-700 flex flex-col">
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-8 border-b dark:border-gray-700 pb-4">Répartition des Tâches</h3>
                <div class="flex-1 flex flex-col justify-center relative">
                    <canvas id="tasksChart" width="400" height="400"></canvas>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-center pt-8">
                        <span class="block text-[10px] font-black uppercase text-gray-400 tracking-widest leading-none">Complété</span>
                        <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400 leading-none">
                            {{ $stats['total'] > 0 ? round(($stats['completed'] / $stats['total']) * 100) : 0 }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('tasksChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Terminées', 'En attente', 'Urgentes'],
                    datasets: [{
                        data: [
                            {{ $stats['completed'] }}, 
                            {{ $stats['pending'] - $stats['urgent'] }}, 
                            {{ $stats['urgent'] }}
                        ],
                        backgroundColor: [
                            '#10b981', // emerald-500
                            '#6366f1', // indigo-500
                            '#f43f5e'  // rose-500
                        ],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    weight: '700',
                                    family: 'Inter'
                                },
                                color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563'
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>
</x-app-layout>

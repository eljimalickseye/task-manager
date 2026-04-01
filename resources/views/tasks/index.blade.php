<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🚀 Dashboard de Productivité') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 📊 Barre de Progression Globale -->
            <div class="mb-10 bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white">Progression Globale</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Vous avez complété {{ $progress }}% de vos objectifs.</p>
                    </div>
                    <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400">{{ $progress }}%</span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-4 overflow-hidden shadow-inner">
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%">
                        <div class="w-full h-full opacity-30 animate-pulse bg-white"></div>
                    </div>
                </div>
            </div>

            <!-- 🔍 Filtres et Recherche -->
            <div class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700">
                <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une tâche..." class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 dark:text-white transition-all">
                    </div>
                    
                    <select name="priority" class="bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 dark:text-white py-3 px-4">
                        <option value="">Toutes les priorités</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                    </select>

                    <select name="status" class="bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 dark:text-white py-3 px-4">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En cours</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminées</option>
                    </select>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-2xl transition-all active:scale-95 shadow-lg shadow-indigo-200 dark:shadow-none">
                        Filtrer
                    </button>
                    @if(request()->anyFilled(['search', 'priority', 'status']))
                        <a href="{{ route('tasks.index') }}" class="flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300 font-bold py-3 px-6 rounded-2xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 dark:border-gray-700">
                <div class="p-8 md:p-10">
                    
                    <div class="flex justify-between items-center mb-10">
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Liste des Tâches</h2>
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 shadow-xl shadow-indigo-100 dark:shadow-none transition-all">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Nouvelle Tâche
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($tasks as $task)
                            <div class="group relative bg-gray-50 dark:bg-gray-900/50 p-6 rounded-3xl border-2 border-transparent hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                                
                                <!-- Category & Priority Badge -->
                                <div class="flex justify-between items-start mb-4">
                                    <span class="px-3 py-1 bg-white dark:bg-gray-800 text-[10px] font-black uppercase text-indigo-500 dark:text-indigo-400 rounded-full border border-indigo-100 dark:border-indigo-900">{{ $task->category }}</span>
                                    
                                    @if($task->priority === 'high')
                                        <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900/30 text-[10px] font-black uppercase text-rose-600 dark:text-rose-400 rounded-full border border-rose-200 dark:border-rose-800">Urgente</span>
                                    @elseif($task->priority === 'medium')
                                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-[10px] font-black uppercase text-amber-600 dark:text-amber-400 rounded-full border border-amber-200 dark:border-amber-800">Moyenne</span>
                                    @else
                                        <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-[10px] font-black uppercase text-emerald-600 dark:text-emerald-400 rounded-full border border-emerald-200 dark:border-emerald-800">Basse</span>
                                    @endif
                                </div>

                                <!-- Title & Description -->
                                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 line-clamp-1 {{ $task->completed ? 'line-through opacity-50' : '' }}">{{ $task->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-6 line-clamp-2">{{ $task->description }}</p>

                                <!-- Footer Info -->
                                <div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4 mt-auto">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Échéance</span>
                                        <span class="text-xs font-black {{ $task->due_at && $task->due_at->isPast() && !$task->completed ? 'text-rose-500' : 'text-gray-600 dark:text-gray-300' }}">
                                            {{ $task->due_at ? $task->due_at->format('d M, Y') : 'Non définie' }}
                                        </span>
                                    </div>

                                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity translate-x-4 group-hover:translate-x-0 transition-transform duration-300">
                                        <a href="{{ route('tasks.edit', $task) }}" class="p-2 bg-white dark:bg-gray-800 text-indigo-500 rounded-xl hover:bg-indigo-500 hover:text-white transition-all shadow-sm">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-white dark:bg-gray-800 text-rose-500 rounded-xl hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Completed Checkmark Overlay -->
                                @if($task->completed)
                                    <div class="absolute top-2 right-2 p-1 bg-emerald-500 text-white rounded-full">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <div class="inline-block p-10 bg-gray-50 dark:bg-gray-900/50 rounded-full mb-6">
                                    <svg class="h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Aucune tâche trouvée</h3>
                                <p class="text-gray-500 font-medium">Réessayez avec d'autres filtres ou créez une nouvelle tâche.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

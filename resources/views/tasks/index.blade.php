<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🎯 Vos Objectifs Stratégiques') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen transition-all duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 📊 Barre de Progression Globale -->
            <div class="mb-10 bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 dark:bg-indigo-900/10 rounded-full group-hover:scale-110 transition-transform duration-1000"></div>
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 relative z-10 gap-4">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white font-heading tracking-tight">Performance Globale</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium tracking-wide italic">Vous avez accompli {{ $progress }}% de vos projets actuels.</p>
                    </div>
                    <div class="text-5xl font-black text-indigo-600 dark:text-indigo-400 font-heading">{{ $progress }}%</div>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-5 overflow-hidden shadow-inner relative z-10">
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%">
                        <div class="w-full h-full opacity-30 animate-pulse bg-white"></div>
                    </div>
                </div>
            </div>

            <!-- 🔍 Filtres et Recherche High-End -->
            <div class="mb-12 bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl p-8 rounded-[2rem] shadow-2xl border border-white/50 dark:border-gray-700">
                <form action="{{ route('tasks.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5 relative group">
                        <svg class="absolute left-5 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Trouver une tâche..." class="w-full pl-14 pr-4 py-4 bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white transition-all font-bold">
                    </div>
                    
                    <div class="md:col-span-3">
                        <select name="priority" class="w-full bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white py-4 px-6 font-bold">
                            <option value="">Toutes Priorités</option>
                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Basse</option>
                            <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Moyenne</option>
                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 Haute</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <select name="status" class="w-full bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white py-4 px-6 font-bold">
                            <option value="">Tous Statuts</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⚡ En cours</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Terminées</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all active:scale-95 shadow-xl shadow-indigo-200 dark:shadow-none uppercase text-xs tracking-widest">
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>

            <!-- Empty State Illustration Placeholder replacement by Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($tasks as $task)
                    <div class="group relative bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] shadow-xl border border-gray-100 dark:border-gray-700 hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:-translate-y-3 transition-all duration-500 overflow-hidden {{ $task->completed ? 'opacity-75 grayscale-[0.5]' : '' }}">
                        
                        <!-- Glow effect matching priority -->
                        <div class="absolute -right-8 -top-8 w-24 h-24 rounded-full blur-3xl opacity-0 group-hover:opacity-40 transition-opacity duration-500
                            {{ $task->priority === 'high' ? 'bg-rose-500' : ($task->priority === 'medium' ? 'bg-amber-500' : 'bg-emerald-500') }}"></div>

                        <div class="flex justify-between items-start mb-6">
                            <div class="flex flex-col">
                                <span class="px-4 py-1.5 bg-gray-50 dark:bg-gray-700 text-[10px] font-black uppercase text-indigo-500 dark:text-indigo-400 rounded-xl border border-gray-100 dark:border-gray-600 mb-2 w-fit tracking-tighter">
                                    {{ $task->category }}
                                </span>
                                @if($task->priority === 'high')
                                    <span class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] animate-pulse">🔥 Urgent</span>
                                @endif
                            </div>

                            <form action="{{ route('tasks.update', $task) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="completed" value="{{ $task->completed ? '0' : '1' }}">
                                <input type="hidden" name="title" value="{{ $task->title }}">
                                <input type="hidden" name="priority" value="{{ $task->priority }}">
                                <input type="hidden" name="category" value="{{ $task->category }}">
                                <button type="submit" class="p-3 {{ $task->completed ? 'bg-emerald-500 text-white' : 'bg-gray-50 dark:bg-gray-700 text-gray-300 dark:text-gray-500 hover:text-indigo-500' }} rounded-2xl transition-all shadow-lg hover:scale-110 active:rotate-12">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                        </div>

                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3 line-clamp-1 group-hover:text-indigo-600 transition-colors {{ $task->completed ? 'line-through decoration-emerald-500 decoration-4' : '' }}">
                            {{ $task->title }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 font-medium mb-8 line-clamp-2 h-12">{{ $task->description }}</p>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-50 dark:border-gray-700">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 leading-none">Échéance</span>
                                <span class="text-sm font-black font-heading {{ $task->due_at && $task->due_at->isPast() && !$task->completed ? 'text-rose-500 animate-pulse' : 'text-gray-700 dark:text-gray-300' }}">
                                    @if($task->due_at)
                                        {{ $task->due_at->format('d M, Y') }}
                                        <span class="text-[10px] opacity-50">{{ $task->due_at->format('H:i') }}</span>
                                    @else
                                        - Sans date -
                                    @endif
                                </span>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('tasks.edit', $task) }}" class="p-4 bg-gray-50 dark:bg-gray-700 text-gray-400 hover:bg-indigo-600 hover:text-white rounded-2xl transition-all hover:rotate-3 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-4 bg-gray-50 dark:bg-gray-700 text-gray-400 hover:bg-rose-600 hover:text-white rounded-2xl transition-all hover:-rotate-3 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center bg-white dark:bg-gray-800 rounded-[3rem] border-4 border-dashed border-gray-100 dark:border-gray-700">
                        <div class="inline-block p-10 bg-indigo-50 dark:bg-indigo-900/20 rounded-full mb-8">
                            <svg class="h-24 w-24 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-4xl font-black text-gray-900 dark:text-white mb-4">Aucune donnée trouvée</h3>
                        <p class="text-gray-500 font-medium max-w-sm mx-auto text-lg leading-relaxed">Ajustez vos filtres de recherche ou créez votre premier jalon de réussite.</p>
                        <a href="{{ route('tasks.create') }}" class="mt-12 inline-block px-12 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-2xl">Lancer un projet</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

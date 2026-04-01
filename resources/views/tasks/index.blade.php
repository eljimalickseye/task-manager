<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🎯 Vos Objectifs Stratégiques') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            
            <!-- Progression Globale -->
            <div class="mb-10 bg-white dark:bg-gray-800 p-8 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 relative z-10 gap-4">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white font-heading tracking-tight">Performance Globale</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium italic">Complétion : {{ $progress }}%</p>
                    </div>
                    <div class="text-5xl font-black text-indigo-600 dark:text-indigo-400 font-heading">{{ $progress }}%</div>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-5 overflow-hidden shadow-inner relative z-10">
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mb-12 bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl p-8 rounded-[2rem] shadow-2xl border border-white/50 dark:border-gray-700">
                <form action="{{ route('tasks.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5 relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Trouver une tâche..." class="w-full pl-6 pr-4 py-4 bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white transition-all font-bold">
                    </div>
                    
                    <div class="md:col-span-3">
                        <select name="priority" class="w-full bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white py-4 px-6 font-bold">
                            <option value="">Priorités</option>
                            <option value="low" @selected(request('priority') == 'low')>🟢 Basse</option>
                            <option value="medium" @selected(request('priority') == 'medium')>🟡 Moyenne</option>
                            <option value="high" @selected(request('priority') == 'high')>🔴 Haute</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <select name="status" class="w-full bg-gray-50 dark:bg-gray-700/50 border-none rounded-2xl focus:ring-4 focus:ring-indigo-500/10 dark:text-white py-4 px-6 font-bold">
                            <option value="">Statuts</option>
                            <option value="pending" @selected(request('status') == 'pending')>⚡ En cours</option>
                            <option value="completed" @selected(request('status') == 'completed')>✅ Terminée</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all shadow-xl uppercase text-xs">Filtrer</button>
                    </div>
                </form>
            </div>

            <!-- Grille des Tâches -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($tasks as $task)
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] shadow-xl border border-gray-100 dark:border-gray-700 transition-all {{ $task->completed ? 'opacity-70' : '' }}">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-4 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-[10px] font-black uppercase text-indigo-600 dark:text-indigo-400 rounded-xl">
                                {{ $task->category }}
                            </span>

                            <form action="{{ route('tasks.update', $task) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="title" value="{{ $task->title }}">
                                <input type="hidden" name="priority" value="{{ $task->priority }}">
                                <input type="hidden" name="category" value="{{ $task->category }}">
                                <input type="hidden" name="completed" value="{{ $task->completed ? '0' : '1' }}">
                                <button type="submit" class="p-3 {{ $task->completed ? 'bg-emerald-500 text-white' : 'bg-gray-50 dark:bg-gray-700 text-gray-300' }} rounded-2xl shadow-lg">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                        </div>

                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2 {{ $task->completed ? 'line-through decoration-emerald-500 decoration-2 text-gray-400' : '' }}">
                            {{ $task->title }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 font-medium mb-6 line-clamp-2">{{ $task->description }}</p>

                        <div class="pt-6 border-t dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none">Échéance</span>
                                <span class="text-sm font-black text-gray-700 dark:text-gray-200">
                                    {{ $task->due_at?->format('d M, Y') ?? '- Sans date -' }}
                                </span>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="p-3 bg-gray-50 dark:bg-gray-700 text-gray-400 hover:text-indigo-600 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-3 bg-gray-50 dark:bg-gray-700 text-gray-400 hover:text-rose-600 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-gray-400 font-bold">Aucune tâche disponible.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('✏️ Modification de précision') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 dark:border-gray-700">
                <div class="p-8 md:p-12 text-gray-900 dark:text-gray-100">
                    <div class="mb-10 text-center md:text-left flex flex-col md:flex-row justify-between items-center bg-gray-50 dark:bg-gray-700/30 p-8 rounded-3xl border border-gray-100 dark:border-gray-700">
                        <div class="flex-1">
                            <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight leading-none mb-3">Détails de la tâche</h1>
                            <p class="text-lg text-gray-500 dark:text-gray-400 font-medium">Réajustez vos paramètres pour une efficacité maximale.</p>
                        </div>
                        
                        <div class="flex items-start bg-emerald-50/50 dark:bg-emerald-900/10 p-6 rounded-2xl border-2 border-emerald-100 dark:border-emerald-900/30">
                            <div class="flex items-center h-8">
                                <input type="hidden" name="completed" value="0" form="task-form">
                                <input id="completed" name="completed" type="checkbox" value="1" {{ $task->completed ? 'checked' : '' }} form="task-form"
                                    class="focus:ring-emerald-500 h-8 w-8 text-emerald-600 dark:text-emerald-500 bg-white dark:bg-gray-900 border-2 border-emerald-300 dark:border-emerald-700 rounded-xl cursor-pointer transition-all">
                            </div>
                            <div class="ml-4">
                                <label for="completed" class="font-black text-xl text-emerald-900 dark:text-emerald-300 cursor-pointer block leading-none">Terminée</label>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('tasks.update', $task) }}" method="POST" id="task-form" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Titre -->
                            <div class="md:col-span-2 group">
                                <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Titre de la tâche</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-lg p-6 transition-all duration-300 font-bold" required>
                            </div>

                            <!-- Catégorie -->
                            <div class="group">
                                <label for="category" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Catégorie</label>
                                <input type="text" name="category" id="category" value="{{ old('category', $task->category) }}" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300" required>
                            </div>

                            <!-- Priorité -->
                            <div class="group">
                                <label for="priority" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Priorité</label>
                                <select name="priority" id="priority" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300">
                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Bas</option>
                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyen</option>
                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Haut</option>
                                </select>
                            </div>

                            <!-- Date d'échéance -->
                            <div class="group">
                                <label for="due_at" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Date d'échéance</label>
                                <input type="datetime-local" name="due_at" id="due_at" value="{{ $task->due_at ? $task->due_at->format('Y-m-d\TH:i') : '' }}" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300">
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2 group">
                                <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Notes & Détails</label>
                                <textarea name="description" id="description" rows="5" class="block w-full bg-gray-50 dark:bg-gray-900 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500">{{ old('description', $task->description) }}</textarea>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-end gap-6 pt-10 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('tasks.index') }}" class="w-full sm:w-auto text-center px-10 py-5 text-sm font-bold text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-all duration-200 uppercase tracking-widest">
                                Annuler
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-12 py-5 bg-indigo-600 border border-transparent rounded-2xl font-black text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/50 active:scale-95 transition-all shadow-2xl shadow-indigo-100 dark:shadow-none">
                                Actualiser
                                <svg class="ml-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m0 0H15"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

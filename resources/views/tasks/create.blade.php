<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('🆕 Nouvelle Tâche Power-Up') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 dark:bg-gray-900/50 min-h-screen transition-all duration-300">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 dark:border-gray-700">
                <div class="p-8 md:p-12 text-gray-900 dark:text-gray-100">
                    <div class="mb-10 text-center md:text-left">
                        <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-3">Définir un nouvel objectif</h1>
                        <p class="text-lg text-gray-500 dark:text-gray-400 font-medium">Précisez les détails pour optimiser votre productivité.</p>
                    </div>

                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Titre -->
                            <div class="md:col-span-2 group">
                                <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600 dark:group-focus-within:text-indigo-400 font-black uppercase tracking-widest text-[10px]">Titre de la tâche</label>
                                <input type="text" name="title" id="title" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500" required placeholder="Ex: Développer le module de paiement...">
                            </div>

                            <!-- Catégorie -->
                            <div class="group">
                                <label for="category" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Catégorie</label>
                                <input type="text" name="category" id="category" value="Professionnel" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300" required>
                            </div>

                            <!-- Priorité -->
                            <div class="group">
                                <label for="priority" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Priorité</label>
                                <select name="priority" id="priority" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300">
                                    <option value="low">Bas (Normal)</option>
                                    <option value="medium" selected>Moyen (Important)</option>
                                    <option value="high">Haut (Urgent)</option>
                                </select>
                            </div>

                            <!-- Date d'échéance -->
                            <div class="group">
                                <label for="due_at" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Date d'échéance</label>
                                <input type="datetime-local" name="due_at" id="due_at" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300">
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2 group">
                                <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 ml-1 font-black uppercase tracking-widest text-[10px]">Description détaillée</label>
                                <textarea name="description" id="description" rows="5" class="block w-full bg-gray-50 dark:bg-gray-700/50 border-2 border-gray-100 dark:border-gray-600 rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 sm:text-base p-5 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500" placeholder="Décrivez les étapes ou notes pour accomplir cette tâche..."></textarea>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-10 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('tasks.index') }}" class="w-full sm:w-auto text-center px-8 py-4 text-sm font-bold text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-all duration-200 uppercase tracking-widest">
                                Revenir
                            </a>
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-5 bg-indigo-600 border border-transparent rounded-2xl font-black text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/50 active:scale-95 transition-all shadow-2xl shadow-indigo-100 dark:shadow-none">
                                Lancer la tâche
                                <svg class="ml-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

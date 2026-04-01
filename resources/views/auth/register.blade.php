<x-guest-layout>
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-2 uppercase font-heading">Rejoignez-nous</h1>
        <p class="text-sm text-gray-500 font-medium">Créez votre compte pour commencer à gérer vos projets.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="group">
            <label for="name" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest mb-2 group-focus-within:text-indigo-600 transition-colors">Nom Complet</label>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1 text-gray-300 pointer-events-none group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                    class="block w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="Jean Dupont">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-rose-500" />
        </div>

        <!-- Email Address -->
        <div class="group">
            <label for="email" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest mb-2 group-focus-within:text-indigo-600 transition-colors">Email Professionnel</label>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1 text-gray-300 pointer-events-none group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="jean@taskflow.pro">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-rose-500" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="group">
                <label for="password" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest mb-2 group-focus-within:text-indigo-600 transition-colors">Mot de Passe</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
            </div>

            <div class="group">
                <label for="password_confirmation" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest mb-2 group-focus-within:text-indigo-600 transition-colors">Confirmation</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-rose-500" />
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full inline-flex items-center justify-center px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 active:scale-95 transition-all shadow-2xl shadow-indigo-100 dark:shadow-none">
                Créer mon compte
                <svg class="ml-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </button>
        </div>
        
        <div class="text-center pt-8 border-t border-gray-50 dark:border-gray-800">
            <p class="text-xs font-bold text-gray-400">Déjà inscrit ? 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 transition-colors">Connectez-vous ici</a>
            </p>
        </div>
    </form>
</x-guest-layout>

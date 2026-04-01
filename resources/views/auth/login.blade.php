<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 px-4 py-3 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 font-bold rounded-2xl border border-emerald-100 dark:border-emerald-800" :status="session('status')" />

    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-2 uppercase font-heading">S'authentifier</h1>
        <p class="text-sm text-gray-500 font-medium">Bon retour parmi nous ! Vos tâches vous attendent.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="group">
            <label for="email" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest mb-2 group-focus-within:text-indigo-600 transition-colors">Votre Adresse Email</label>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1 text-gray-300 pointer-events-none group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="block w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="exemple@domaine.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-rose-500" />
        </div>

        <!-- Password -->
        <div class="group">
            <div class="flex justify-between mb-2 items-center">
                <label for="password" class="block text-[11px] font-black uppercase text-gray-400 tracking-widest group-focus-within:text-indigo-600 transition-colors">Mot de Passe Sécurisé</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-indigo-500 hover:text-indigo-600 transition-colors" href="{{ route('password.request') }}">Oublié ?</a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 p-1 text-gray-300 pointer-events-none group-focus-within:text-indigo-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 dark:text-gray-100 transition-all font-bold placeholder-gray-300" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-rose-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-none bg-gray-100 dark:bg-gray-800 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer" name="remember">
                <span class="ms-3 text-xs font-bold text-gray-500 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors">Rester connecté</span>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full inline-flex items-center justify-center px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 active:scale-95 transition-all shadow-2xl shadow-indigo-100 dark:shadow-none">
                Se Connecter
                <svg class="ml-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </div>
        
        <div class="text-center pt-8 border-t border-gray-50 dark:border-gray-800">
            <p class="text-xs font-bold text-gray-400">Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 transition-colors">Créer un compte Power-Up</a>
            </p>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
             <div class="text-[#0a66c2] text-3xl font-bold tracking-tight flex items-center gap-1">
                Professional<span class="bg-[#0a66c2] text-white px-1.5 py-0.5 rounded-sm text-2xl">Connect</span>
            </div>
        </div>

        <div class="bg-white px-8 py-8 shadow-[0_4px_12px_rgba(0,0,0,0.15)] sm:rounded-xl border border-gray-100">
            <div class="mb-6">
                <h1 class="text-3xl font-semibold text-gray-900 mb-1">S'identifier</h1>
                <p class="text-sm text-gray-500">Restez au courant de votre monde professionnel</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail ou téléphone</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                @if (Route::has('password.request'))
                    <div class="flex items-center justify-start">
                        <a class="text-sm font-medium text-[#0a66c2] hover:text-[#004182] hover:underline transition" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    </div>
                @endif

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-base font-semibold text-white bg-[#0a66c2] hover:bg-[#004182] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0a66c2] transition-colors duration-200">
                        S'identifier
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-gray-500">Nouveau sur ProfessionalConnect ?</span>
                <a href="{{ route('register') }}" class="font-semibold text-[#0a66c2] hover:text-[#004182] hover:underline transition ml-1">
                    S'inscrire
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

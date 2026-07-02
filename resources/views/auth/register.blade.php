<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
             <div class="text-[#0a66c2] text-3xl font-bold tracking-tight flex items-center gap-1">
                Professional<span class="bg-[#0a66c2] text-white px-1.5 py-0.5 rounded-sm text-2xl">Connect</span>
            </div>
        </div>

        <div class="bg-white px-8 py-8 shadow-[0_4px_12px_rgba(0,0,0,0.15)] sm:rounded-xl border border-gray-100">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-semibold text-gray-900 mb-1">Tirez le meilleur parti de votre vie professionnelle</h1>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Prénom et nom</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Headline -->
                <div>
                    <label for="headline" class="block text-sm font-medium text-gray-700 mb-1">Titre professionnel (ex: Développeur Web)</label>
                    <input id="headline" type="text" name="headline" value="{{ old('headline') }}" required autocomplete="headline"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('headline')" class="mt-1" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe (6 caractères minimum)</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="block w-full border-gray-300 rounded-md focus:border-[#0a66c2] focus:ring-[#0a66c2] sm:text-sm py-2.5 px-3 border transition-colors shadow-sm">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-4">
                    <p class="text-xs text-gray-500 text-center mb-4">
                        En cliquant sur S’inscrire, vous acceptez les Conditions d’utilisation, la Politique de confidentialité et la Politique relative aux cookies de ProfessionalConnect.
                    </p>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-base font-semibold text-white bg-[#0a66c2] hover:bg-[#004182] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0a66c2] transition-colors duration-200">
                        Accepter et s'inscrire
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                <span class="text-gray-500">Vous avez déjà un compte ?</span>
                <a href="{{ route('login') }}" class="font-semibold text-[#0a66c2] hover:text-[#004182] hover:underline transition ml-1">
                    S'identifier
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

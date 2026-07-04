<section>
    <header>
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Informations du profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <!-- Avatar Preview (Optional Visual) -->
        <div class="flex items-center gap-4 mb-4">
             <img src="{{ old('image_url', $user->image_url) ?? ($user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random') }}"
                  alt="Profile Preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
             <div class="text-sm text-gray-500">Ceci est votre photo de profil actuelle.</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <x-input-label for="name" value="Nom complet" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#0a66c2] focus:ring-[#0a66c2] rounded-md shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="Adresse e-mail" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 focus:border-[#0a66c2] focus:ring-[#0a66c2] rounded-md shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            Votre e-mail n'est pas vérifié.
                            <button form="send-verification" class="underline text-sm text-[#0a66c2] hover:text-[#004182] focus:outline-none">
                                Cliquez ici pour renvoyer l'e-mail.
                            </button>
                        </p>
                    </div>
                @endif
            </div>

            <div class="md:col-span-2">
                <x-input-label for="headline" value="Titre professionnel (Headline)" />
                <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#0a66c2] focus:ring-[#0a66c2] rounded-md shadow-sm" :value="old('headline', $user->headline)" required />
                <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                <p class="mt-1 text-xs text-gray-400">Apparaît sous votre nom sur votre profil et vos posts.</p>
            </div>

            <div class="md:col-span-2">
                <x-input-label for="company" value="Entreprise actuelle" />
                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full border-gray-300 focus:border-[#0a66c2] focus:ring-[#0a66c2] rounded-md shadow-sm" :value="old('company', $user->company)" />
                <x-input-error class="mt-2" :messages="$errors->get('company')" />
            </div>

            <!-- URL Image Text Input (As per your logic) -->
            <div class="md:col-span-2">
                <x-input-label for="image_url" value="URL de la photo de profil" />
                <x-text-input id="image_url" name="image_url" type="url" class="mt-1 block w-full border-gray-300 focus:border-[#0a66c2] focus:ring-[#0a66c2] rounded-md shadow-sm text-sm" :value="old('image_url', $user->image_url)" placeholder="https://exemple.com/photo.jpg" />
                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100 mt-6">
            <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-[#0a66c2] hover:bg-[#004182] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0a66c2] transition">
                Enregistrer les modifications
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-md">
                    Enregistré.
                </p>
            @endif
        </div>
    </form>
</section>

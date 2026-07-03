<x-app-layout>
    <div class="min-h-screen bg-[#F3F2EF] py-8">
        <div class="max-w-[1128px] mx-auto px-4">

            <!-- Profile Header Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Cover Photo (Mock) -->
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600"></div>

                <div class="px-6 pb-6 relative">
                    <!-- Avatar -->
                    <img src="{{ $user->avatar_url }}"
                         alt="{{ $user->name }}"
                         class="w-36 h-36 rounded-full border-4 border-white -mt-16 bg-white object-cover">

                    <div class="mt-4 flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600 text-lg">{{ $user->headline }}</p>
                            <p class="text-gray-500 text-sm mt-1 flex items-center gap-1">
                                <i class="w-4 h-4" data-lucide="building"></i>
                                {{ $user->company ?? 'Non renseigné' }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            @if(Auth::id() !== $user->id)
                                <button class="bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-2 px-6 rounded-full transition">
                                    Ajouter au réseau
                                </button>
                            @else
                                <a  class="border border-[#0a66c2] text-[#0a66c2] hover:bg-blue-50 font-semibold py-2 px-6 rounded-full transition">
                                    Modifier le profil
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-6">
                <!-- Left Column: About/Infos -->
                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="font-bold text-gray-900 mb-4">À propos</h2>
                        <p class="text-gray-600 text-sm">
                            Profil professionnel de {{ $user->name }}. Actuellement chez {{ $user->company ?? '?' }}.
                        </p>
                    </div>
                </div>

                <!-- Right Column: User Posts -->
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <h2 class="font-bold text-gray-900 text-xl">Activités</h2>

                    @forelse($user->posts as $post)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <img src="{{ $user->avatar_url }}" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-bold text-sm">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-800 text-sm">{{ $post->content }}</p>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center text-gray-500">
                            Aucune activité récente.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

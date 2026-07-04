<x-app-layout>
    <div class="min-h-screen bg-[#F3F2EF] pb-10">
        <div class="max-w-[1128px] mx-auto">

            <!-- Profile Header Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Cover Photo (Mock) -->
                <div class="h-48 bg-gradient-to-r from-gray-300 to-gray-400"></div>

                <div class="px-6 pb-6 relative">
                    <!-- Avatar -->
                    <img src="{{ $user->avatar_url }}"
                         alt="{{ $user->name }}"
                         class="w-36 h-36 rounded-full border-4 border-white -mt-16 bg-white object-cover shadow-sm">

                    <div class="mt-4 flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600 text-lg mt-0.5">{{ $user->headline }}</p>
                            <p class="text-gray-500 text-sm mt-1">
                                {{ $user->company ?? 'Entreprise non renseignée' }}
                            </p>
                            <p class="text-gray-400 text-sm mt-1">Beni Mellal, Maroc</p>
                        </div>

                        <!-- Actions & Connection Buttons -->
                        <div class="flex gap-2">
                            @if(Auth::id() !== $user->id)
                                @php
                                    $status = auth()->user()->connectionStatus($user->id);
                                @endphp

                                @if(!$status)
                                    <!-- Ajouter -->
                                    <form action="{{ route('connections.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="connected_user_id" value="{{ $user->id }}">
                                        <button type="submit" class="bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-2 px-6 rounded-full transition shadow-sm">
                                            Ajouter au réseau
                                        </button>
                                    </form>
                                @elseif($status['status'] === 'pending')
                                    @if($status['sender_id'] === Auth::id())
                                        <!-- Invitation envoyée -->
                                        <div class="flex items-center gap-2 bg-gray-50 border border-gray-100 px-4 py-2 rounded-full">
                                            <span class="text-gray-600 text-sm font-semibold">Invitation envoyée</span>
                                            <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline text-sm font-semibold">Annuler</button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Accepter / Refuser -->
                                        <div class="flex gap-2">
                                            <form action="{{ route('connections.accept', $status['id']) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-2 px-6 rounded-full transition">Accepter</button>
                                            </form>
                                            <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="border border-red-500 text-red-500 hover:bg-red-50 font-semibold py-2 px-6 rounded-full transition">Refuser</button>
                                            </form>
                                        </div>
                                    @endif
                                @elseif($status['status'] === 'accepted')
                                    <!-- Connecté -->
                                    <div class="flex items-center gap-2 bg-green-50 border border-green-100 px-4 py-2 rounded-full">
                                        <span class="text-green-600 text-sm font-semibold flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                            Connecté
                                        </span>
                                        <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Retirer cette connexion ?')" class="text-gray-500 hover:text-red-500 hover:underline text-sm font-semibold transition ml-2">Retirer</button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('profile.edit') }}" class="border border-[#0a66c2] text-[#0a66c2] hover:bg-blue-50 font-semibold py-2 px-6 rounded-full transition">
                                    Modifier le profil
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-12 gap-6 mt-6 px-2">
                <!-- Left Column: About/Infos -->
                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="font-bold text-gray-900 mb-3 text-lg">À propos</h2>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $user->headline }} chez {{ $user->company }}.
                        </p>
                    </div>
                </div>

                <!-- Right Column: User Posts -->
                <div class="col-span-12 lg:col-span-8 space-y-4">
                    <h2 class="font-bold text-gray-900 text-lg">Activités</h2>

                    @forelse($user->posts as $post)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
                            <div class="flex items-center gap-3 mb-4">
                                <img src="{{ $user->avatar_url }}" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm hover:underline">{{ $user->name }}</h4>
                                    <p class="text-[11px] text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-800 text-[14px] leading-relaxed mb-4">{{ $post->content }}</p>

                            @if($post->photo !== 'null' && !empty($post->photo))
                                <div class="w-full h-auto bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="{{ asset('photos/' . $post->photo) }}" class="w-full object-cover">
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center text-gray-500 text-sm">
                            Cet utilisateur n'a pas encore publié d'activités.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

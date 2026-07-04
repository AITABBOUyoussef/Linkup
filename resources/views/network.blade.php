<x-app-layout>
    <div class="py-8 bg-[#f3f2ef] min-h-screen font-sans">
        <div class="max-w-[1128px] mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- Left Sidebar: Pending requests -->
            <div class="col-span-1 md:col-span-4 space-y-4">
                <div class="bg-white rounded-xl shadow-[0_0_0_1px_rgba(0,0,0,0.08)] p-4">
                    <h2 class="font-semibold text-gray-900 text-base mb-4">Invitations en attente</h2>
                    @forelse($pendingRequests as $request)
                        <div class="flex items-start gap-3 mb-4 pb-4 border-b border-gray-100 last:mb-0 last:pb-0 last:border-0">
                            <img src="{{ $request->sender->avatar_url }}" class="w-12 h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <a href="{{ route('user_profil', $request->sender->id) }}" class="font-semibold text-sm text-gray-900 hover:underline">{{ $request->sender->name }}</a>
                                <p class="text-xs text-gray-500 mb-2">{{ $request->sender->headline ?? 'Membre' }}</p>
                                <div class="flex gap-2">
                                    <form action="{{ route('connections.accept', $request->id) }}" method="POST" class="flex-1">
                                        @csrf @method('PATCH')
                                        <button class="w-full bg-[#0a66c2] hover:bg-[#004182] text-white text-xs font-semibold py-1.5 rounded-full transition shadow-sm">Accepter</button>
                                    </form>
                                    <form action="{{ route('connections.destroy', $request->id) }}" method="POST" class="flex-1">
                                        @csrf @method('DELETE')
                                        <button class="w-full border border-gray-500 text-gray-600 hover:bg-gray-50 text-xs font-semibold py-1.5 rounded-full transition">Ignorer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Aucune invitation en attente.</p>
                    @endforelse
                </div>
            </div>

            <!-- Main Content: Search Results / Suggestions -->
            <div class="col-span-1 md:col-span-8 space-y-4">
                <div class="bg-white rounded-xl shadow-[0_0_0_1px_rgba(0,0,0,0.08)] p-4">
                    <h2 class="font-semibold text-gray-900 text-base mb-4">
                        @if($query) Résultats de recherche pour "{{ $query }}" @else Connaissez-vous ces personnes ? @endif
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($users as $u)
                            <div class="border border-gray-200 rounded-xl overflow-hidden text-center relative flex flex-col hover:shadow-md transition">
                                <div class="h-16 bg-gradient-to-r from-gray-200 to-gray-300 w-full"></div>
                                <a href="{{ route('user_profil', $u->id) }}">
                                    <img src="{{ $u->avatar_url }}" class="w-16 h-16 rounded-full object-cover border-2 border-white mx-auto -mt-8 bg-white hover:opacity-90 transition">
                                </a>
                                <div class="p-4 flex-1 flex flex-col">
                                    <a href="{{ route('user_profil', $u->id) }}" class="font-semibold text-gray-900 hover:underline leading-tight">{{ $u->name }}</a>
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2 flex-1">{{ $u->headline ?? 'Membre du réseau' }}</p>

                                    <div class="mt-4">
                                        @php $status = auth()->user()->connectionStatus($u->id); @endphp
                                        @if(!$status)
                                            <form action="{{ route('connections.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="connected_user_id" value="{{ $u->id }}">
                                                <button type="submit" class="w-full border border-[#0a66c2] text-[#0a66c2] hover:bg-blue-50 font-semibold py-1.5 rounded-full transition text-sm flex items-center justify-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                                    Se connecter
                                                </button>
                                            </form>
                                        @elseif($status['status'] === 'pending')
                                            <button class="w-full border border-gray-300 text-gray-500 bg-gray-50 font-semibold py-1.5 rounded-full text-sm cursor-default">
                                                En attente
                                            </button>
                                        @elseif($status['status'] === 'accepted')
                                            <button class="w-full border border-green-500 text-green-600 bg-green-50 font-semibold py-1.5 rounded-full text-sm cursor-default flex items-center justify-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Connecté
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 col-span-full py-8 text-center">Aucun utilisateur trouvé.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

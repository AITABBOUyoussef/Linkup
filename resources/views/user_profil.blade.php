<!-- ... existing code ... -->
                        <!-- Actions -->
                        <div class="flex gap-2">
                            @if(Auth::id() !== $user->id)
                                @php
                                    $status = auth()->user()->connectionStatus($user->id);
                                @endphp

                                @if(!$status)
                                    <!-- ما كاين حتى علاقة، نقدرو نصيفطو طلب -->
                                    <form action="{{ route('connections.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="connected_user_id" value="{{ $user->id }}">
                                        <button type="submit" class="bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-2 px-6 rounded-full transition shadow-sm">
                                            Ajouter au réseau
                                        </button>
                                    </form>
                                @elseif($status['status'] === 'pending')
                                    @if($status['sender_id'] === Auth::id())
                                        <!-- أنا صيفطت الطلب -->
                                        <div class="flex items-center gap-3">
                                            <span class="bg-gray-100 text-gray-600 font-semibold py-2 px-6 rounded-full">Invitation envoyée</span>
                                            <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline text-sm font-semibold">Annuler</button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- هو صيفط ليا الطلب -->
                                        <div class="flex gap-2">
                                            <form action="{{ route('connections.accept', $status['id']) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-2 px-6 rounded-full transition shadow-sm">Accepter</button>
                                            </form>
                                            <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="border border-red-500 text-red-500 hover:bg-red-50 font-semibold py-2 px-6 rounded-full transition">Refuser</button>
                                            </form>
                                        </div>
                                    @endif
                                @elseif($status['status'] === 'accepted')
                                    <!-- مكونيكطيين -->
                                    <div class="flex items-center gap-3">
                                        <span class="bg-green-50 text-green-600 border border-green-200 font-semibold py-2 px-6 rounded-full flex items-center gap-1.5 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            Connecté
                                        </span>
                                        <form action="{{ route('connections.destroy', $status['id']) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Retirer cette connexion ?')" class="text-gray-500 hover:text-red-500 hover:underline text-sm font-semibold transition">Retirer</button>
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
<!-- ... existing code ... -->

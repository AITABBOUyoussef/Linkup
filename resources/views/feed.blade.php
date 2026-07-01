<x-app-layout>
    <div class="py-10 bg-[#F3F2EF] min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Create Post Area -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}"
                         alt="Avatar" class="w-12 h-12 rounded-full object-cover">
                    <a href="{{ route('feed.create') }}"
                       class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-500 text-sm font-medium rounded-full py-3.5 px-5 transition cursor-pointer">
                        Commencer un post...
                    </a>
                </div>
            </div>

            <!-- Feed -->
            <div class="space-y-4">
                @forelse ($posts as $post)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <!-- Post Header -->
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=random' }}"
                                     alt="Avatar" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">{{ $post->user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @if ($post->user_id == auth()->id())
                                <div class="flex gap-2">
                                    <a href="{{ route('feed.edit', $post->id) }}" class="text-gray-400 hover:text-blue-600 text-sm">Modifier</a>
                                    <form action="{{ route('feed.destroy', $post->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer ce post ?')" class="text-gray-400 hover:text-red-600 text-sm">Supprimer</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="px-4 pb-4">
                            <p class="text-gray-800 text-sm leading-relaxed whitespace-pre-wrap">{{ $post->content }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="px-4 py-3 border-t border-gray-100 flex gap-6">
                            <button class="text-sm text-gray-600 font-medium hover:text-blue-600 transition">{{$post->likes>count()}}J'aime
                                                             <input type="hidden" name="post_id" value="{{ $post->id }}">

                            </button>
                            <button class="text-sm btn-commant text-gray-600 font-medium hover:text-blue-600 transition">{{$post->comments->count()}}          return redirect()->route('feed.index')->with('success', 'Commentaire ajouté avec succès');Commenter</button>
                            <button class="text-sm text-gray-600 font-medium hover:text-blue-600 transition">Partager</button>
                        </div>

                        <!-- Zone de Commentaire (Masquée par défaut) -->
                        <div class="bg-gray-50 PlaceC p-4 border-t border-gray-200 hidden">
                            <!-- Formulaire Ajouter Commentaire -->
                            <form action="{{ route('feed_comment.store') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="flex gap-3">
                                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}"
                                        alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                                    <div class="flex-1">
                                        <textarea name="content" rows="2" required
                                                class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400 resize-none"
                                                placeholder="Ajouter un commentaire..."></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                                        <div class="flex justify-end mt-2">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-1 px-4 text-sm rounded-full transition duration-150 shadow-sm">
                                                Publier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Affichage des Commentaires -->
                            <div class="space-y-3">
                                @foreach($post->comments as $comment)
                                    <div class="flex gap-3">
                                        <img src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name).'&background=random' }}"
                                            alt="Avatar" class="w-8 h-8 rounded-full object-cover mt-1">
                                        <div class="flex-1 bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-bold text-gray-900 text-xs">{{ $comment->user->name }}</h4>
                                                    <p class="text-[10px] text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                @if ($comment->user_id == auth()->id())
                                                    <div class="flex gap-2">
                                                        <a href="{{ route('feed_comment.edit', $comment->id) }}" class="text-gray-400 hover:text-blue-600 text-xs">Modifier</a>
                                                        <form action="{{ route('feed_comment.destroy', $comment->id) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Supprimer ?')" class="text-gray-400 hover:text-red-600 text-xs">Supprimer</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="text-gray-900 text-xl mt-1 whitespace-pre-wrap">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-gray-500">Aucun post pour le moment.</p>
                        <a href="{{ route('feed.create') }}" class="text-blue-600 font-bold hover:underline">Soyez le premier à publier !</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        let btnC = document.querySelectorAll(".btn-commant");
        let PlaceC = document.querySelectorAll(".PlaceC");

        btnC.forEach((btn, index) => {
            btn.addEventListener("click", () => {
                PlaceC[index].classList.toggle("hidden");
            });
        });
    </script>
</x-app-layout>

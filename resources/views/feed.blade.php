<x-app-layout>
    <div class="py-6 bg-[#F4F2EE] min-h-screen">
        <div class="max-w-[555px] mx-auto px-4 sm:px-0 space-y-3">

            <!-- Create Post Area -->
            <div class="bg-white rounded-lg shadow-[0_0_0_1px_rgba(0,0,0,0.08),0_2px_3px_rgba(0,0,0,0.08)] p-4">
                <div class="flex items-center gap-2">
                    <img
                        src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0a66c2&color=fff' }}"
                        alt="Avatar" class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                    <a href="{{ route('feed.create') }}"
                        class="flex-1 border border-gray-300 hover:bg-gray-100 text-gray-600 text-[15px] font-medium rounded-full py-3 px-4 transition duration-150">
                        Commencer un post
                    </a>
                </div>
                <div class="flex items-center justify-between mt-3 -mb-1">
                    <button
                        class="flex items-center gap-1.5 text-gray-500 hover:bg-gray-100 px-2 sm:px-3 py-2 rounded-lg transition text-[14px] font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="hidden sm:inline">Photo</span>
                    </button>
                    <button
                        class="flex items-center gap-1.5 text-gray-500 hover:bg-gray-100 px-2 sm:px-3 py-2 rounded-lg transition text-[14px] font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2V12a2 2 0 002 2z" />
                        </svg>
                        <span class="hidden sm:inline">Événement</span>
                    </button>
                    <button
                        class="flex items-center gap-1.5 text-gray-500 hover:bg-gray-100 px-2 sm:px-3 py-2 rounded-lg transition text-[14px] font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="hidden sm:inline">Article</span>
                    </button>
                </div>
            </div>

            <!-- Feed -->
            <div class="space-y-3">
                @forelse ($posts as $post)
                    <div class="bg-white rounded-lg shadow-[0_0_0_1px_rgba(0,0,0,0.08),0_2px_3px_rgba(0,0,0,0.08)] overflow-hidden">

                        <!-- Post Header -->
                        <div class="px-4 pt-3 pb-1 flex items-start justify-between">
                            <div class="flex items-start gap-2">
                                <img
                                    src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) . '&background=random' }}"
                                    alt="Avatar" class="w-12 h-12 rounded-full object-cover">
                                <div class="leading-tight">
                                    <h4
                                        class="font-semibold text-gray-900 text-[14px] hover:text-blue-700 hover:underline cursor-pointer">
                                        {{ $post->user->name }}
                                    </h4>
                                    <p class="text-[12px] text-gray-500">Membre du réseau</p>
                                    <p class="text-[12px] text-gray-500 flex items-center gap-1">
                                        {{ $post->created_at->diffForHumans() }}
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-14a6 6 0 016 6c0 1.887-.898 3.566-2.29 4.633L10 18l-3.71-3.367A5.978 5.978 0 014 10a6 6 0 016-6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </p>
                                </div>
                            </div>
                            @if ($post->user_id == auth()->id())
                                <div class="relative inline-block text-left dropdown">
                                    <button type="button"
                                        class="p-2 hover:bg-gray-100 rounded-full transition dropdown-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                    </button>
                                    <div
                                        class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 hidden z-30">
                                        <a href="{{ route('feed.edit', $post->id) }}"
                                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                            <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Modifier le post
                                        </a>
                                        <form action="{{ route('feed.destroy', $post->id) }}" method="POST"
                                            class="w-full">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Supprimer ce post ?')"
                                                class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <svg class="mr-3 h-4 w-4 text-red-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="px-4 pb-3 pt-1">
                            <p class="text-gray-900 text-[14px] leading-normal whitespace-pre-wrap">{{ $post->content }}</p>
                        </div>
                           <div class="px-4 pb-3 pt-1">
                             <img
                                    src="{{ asset('photos/' . $post->photo) }}" alt="{{ $post->user->name }}""
                                    alt="Avatar" class="w-full flex justify-center h-40 rounded-xl object-cover">
                            <p class="text-gray-900  leading-normal whitespace-pre-wrap">{{ $post->fileName }}</p>
                        </div>


                        <!-- Interactions Meta -->
                        <div class="px-4 pb-2 flex items-center justify-between text-[12px] text-gray-500">
                            <div class="flex items-center gap-1">
                                @if ($post->likes->count() > 0)
                                    <span
                                        class="bg-blue-600 text-white rounded-full w-4 h-4 flex items-center justify-center text-[9px]">👍</span>
                                    <span class="hover:text-blue-700 hover:underline cursor-pointer">{{ $post->likes->count() }}</span>
                                @endif
                            </div>
                            <div class="hover:text-blue-700 hover:underline cursor-pointer">
                                {{ $post->comments->count() }} commentaire{{ $post->comments->count() > 1 ? 's' : '' }}
                            </div>
                        </div>

                        <!-- Actions Bar -->
                        <div class="mx-4 border-t border-gray-200"></div>
                        <div class="px-1 py-1 flex justify-around">
                            @php $hasLiked = $post->likes->contains('user_id', auth()->id()); @endphp
                            <form action="{{ route('feed_like.store') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 py-2.5 rounded-lg transition-colors text-[14px] {{ $hasLiked ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100 font-semibold' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        fill="{{ $hasLiked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10h4.757c1.246 0 2.25 1.004 2.25 2.25 0 .58-.223 1.144-.627 1.573L15.5 19H7V10l7-7v7z" />
                                    </svg>
                                    <span>J'aime</span>
                                </button>
                            </form>
                            <button
                                class="flex-1 btn-comment flex items-center justify-center gap-2 py-2.5 text-gray-600 hover:bg-gray-100 font-semibold rounded-lg transition-colors text-[14px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>Commenter</span>
                            </button>
                            <button
                                class="flex-1 flex items-center justify-center gap-2 py-2.5 text-gray-600 hover:bg-gray-100 font-semibold rounded-lg transition-colors text-[14px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Partager</span>
                            </button>
                        </div>

                        <!-- Comment Area -->
                        <div class="bg-white comment-area px-4 pb-4 border-t border-gray-100 hidden">
                            <form action="{{ route('feed_comment.store') }}" method="POST" class="mt-3 mb-4">
                                @csrf
                                <div class="flex gap-2">
                                    <img
                                        src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                                        alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                                    <div class="flex-1">
                                        <textarea name="content" rows="1" required
                                            class="w-full bg-gray-100 border-0 text-[13px] rounded-2xl focus:ring-1 focus:ring-blue-400 focus:bg-white py-2.5 px-4 placeholder-gray-500 resize-none transition"
                                            placeholder="Ajouter un commentaire..."></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="flex justify-end mt-2">
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-5 rounded-full text-[12px] transition active:scale-95">
                                                Publier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="space-y-3">
                                @foreach ($post->comments as $comment)
                                    <div class="flex gap-2">
                                        <img
                                            src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=random' }}"
                                            alt="Avatar" class="w-8 h-8 rounded-full object-cover mt-0.5">
                                        <div class="flex-1">
                                            <div class="bg-gray-100 px-3 py-2 rounded-2xl inline-block max-w-full">
                                                <h4 class="font-semibold text-gray-900 text-[12px]">
                                                    {{ $comment->user->name }}
                                                </h4>
                                                <p class="text-gray-800 text-[13px] leading-snug">{{ $comment->content }}</p>
                                            </div>
                                            <div class="flex items-center gap-3 mt-1 ml-3 text-[11px] font-semibold text-gray-500">
                                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                @if ($comment->user_id == auth()->id())
                                                    <a href="{{ route('feed_comment.edit', $comment->id) }}"
                                                        class="hover:text-blue-600 hover:underline transition">Modifier</a>
                                                    <form action="{{ route('feed_comment.destroy', $comment->id) }}"
                                                        method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Supprimer ?')"
                                                            class="hover:text-red-600 hover:underline transition">Supprimer</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-[0_0_0_1px_rgba(0,0,0,0.08),0_2px_3px_rgba(0,0,0,0.08)] p-12 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M14 3v5h5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun post pour le moment</h3>
                        <p class="text-gray-500 text-sm mb-6">Partagez vos pensées avec votre réseau professionnel.</p>
                        <a href="{{ route('feed.create') }}"
                            class="inline-flex items-center px-8 py-2.5 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition shadow-sm active:scale-95">
                            Commencer un post
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dropdown Toggle
            document.querySelectorAll('.dropdown-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const menu = btn.nextElementSibling;
                    const isOpen = !menu.classList.contains('hidden');
                    document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
                    if (!isOpen) menu.classList.remove('hidden');
                });
            });

            // Comment Toggle
            document.querySelectorAll('.btn-comment').forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    const area = document.querySelectorAll('.comment-area')[index];
                    area.classList.toggle('hidden');
                    if (!area.classList.contains('hidden')) {
                        const textarea = area.querySelector('textarea');
                        if (textarea) textarea.focus();
                    }
                });
            });

            // Global Click to close
            window.addEventListener('click', () => {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
            });
        });
    </script>
</x-app-layout>

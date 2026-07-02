<x-app-layout>
    <div class="py-8 bg-[#f3f2ef] min-h-screen font-sans">
        <!-- Main Grid Container -->
        <div class="max-w-[1128px] mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- Left Sidebar (Profile Snippet - Hidden on Mobile) -->
            <div class="hidden md:block md:col-span-3 space-y-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-center pb-4">
                    <div class="h-16 bg-gray-200" style="background-image: url('https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
                    <div class="flex justify-center -mt-8 mb-2">
                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" alt="Profile" class="w-16 h-16 rounded-full border-2 border-white object-cover bg-white">
                    </div>
                    <h3 class="font-semibold text-gray-900 text-base leading-tight hover:underline cursor-pointer"><a href="{{ route('profile.edit') }}">{{ auth()->user()->name }}</a></h3>
                    <p class="text-xs text-gray-500 mt-1 px-4 line-clamp-2">{{ auth()->user()->headline ?? 'Membre' }}</p>

                    <div class="border-t border-gray-100 mt-4 pt-4 text-left px-4">
                         <div class="flex justify-between items-center text-xs font-semibold text-gray-500 hover:bg-gray-50 cursor-pointer p-1 rounded transition">
                             <span>Relations</span>
                             <span class="text-[#0a66c2]">0</span>
                         </div>
                         <p class="text-xs font-bold text-gray-900 ml-1">Développez votre réseau</p>
                    </div>
                </div>
            </div>

            <!-- Center Feed (Posts) -->
            <div class="col-span-1 md:col-span-6 space-y-4">

                <!-- Create Post Box -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center gap-2">
                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover shrink-0 border border-gray-100">
                        <a href="{{ route('feed.create') }}" class="flex-1 border border-gray-400 hover:bg-gray-100 text-gray-500 text-sm font-medium rounded-full py-3 px-5 transition text-left cursor-text">
                            Commencer un post
                        </a>
                    </div>

                    <div class="flex items-center justify-around mt-3 pt-2">
                        <a href="{{ route('feed.create') }}" class="flex items-center gap-2 text-gray-500 hover:bg-gray-100 px-3 py-2 rounded-md transition text-sm font-semibold cursor-pointer">
                            <svg class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm1 13a1 1 0 01-1 1H5a1 1 0 01-1-1v-4.586l3.293-3.293a1 1 0 011.414 0l3.346 3.346a1 1 0 001.414 0l3.536-3.536a1 1 0 011.414 0L20 12.586V17zm0-6.414l-3.293-3.293a3 3 0 00-4.242 0l-3.536 3.536-2.586-2.586a3 3 0 00-4.242 0L2 10.586V7a1 1 0 011-1h14a1 1 0 011 1v3.586z"></path></svg>
                            <span class="hidden sm:inline">Média</span>
                        </a>
                        <a href="{{ route('feed.create') }}" class="flex items-center gap-2 text-gray-500 hover:bg-gray-100 px-3 py-2 rounded-md transition text-sm font-semibold cursor-pointer">
                            <svg class="h-6 w-6 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-7 5h5v5h-5v-5z"></path></svg>
                            <span class="hidden sm:inline">Événement</span>
                        </a>
                        <a href="{{ route('feed.create') }}" class="flex items-center gap-2 text-gray-500 hover:bg-gray-100 px-3 py-2 rounded-md transition text-sm font-semibold cursor-pointer">
                            <svg class="h-6 w-6 text-orange-800" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-4h11v4zm0-5H4V9h11v4zm5 5h-4V9h4v9z"></path></svg>
                            <span class="hidden sm:inline">Article</span>
                        </a>
                    </div>
                </div>

                <div class="flex items-center my-2">
                    <hr class="flex-grow border-gray-300">
                    <span class="px-2 text-xs text-gray-500">Classer par: <strong class="text-black">Pertinence</strong></span>
                </div>

                <!-- Feed Posts -->
                <div class="space-y-4 pb-20 md:pb-0">
                    @forelse ($posts as $post)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                            <!-- Post Header -->
                            <div class="px-4 pt-3 pb-1 flex items-start justify-between">
                                <div class="flex items-start gap-3">
                                    <img src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) . '&background=random' }}"
                                        alt="Avatar" class="w-12 h-12 rounded-full object-cover border border-gray-100">
                                    <div class="leading-tight">
                                        <h4 class="font-semibold text-gray-900 text-sm hover:text-[#0a66c2] hover:underline cursor-pointer leading-none">
                                            {{ $post->user->name }}
                                        </h4>
                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $post->user->headline ?? 'Membre' }} @if($post->user->company) chez {{ $post->user->company }} @endif</p>
                                        <p class="text-[11px] text-gray-500 flex items-center gap-1 mt-0.5">
                                            {{ $post->created_at->diffForHumans() }}
                                            <span class="w-1 h-1 bg-gray-400 rounded-full inline-block mx-0.5"></span>
                                            <svg class="w-3 h-3 fill-current text-gray-400" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" /></svg>
                                        </p>
                                    </div>
                                </div>

                                <!-- Post Options Dropdown -->
                                @if ($post->user_id == auth()->id())
                                    <div class="relative inline-block text-left dropdown">
                                        <button type="button" class="p-1.5 hover:bg-gray-100 rounded-full transition dropdown-btn text-gray-500 focus:outline-none">
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                                        </button>
                                        <div class="dropdown-menu absolute right-0 mt-1 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-1 hidden z-30">
                                            <a href="{{ route('feed.edit', $post->id) }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 font-medium hover:bg-gray-100">
                                                <svg class="mr-3 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                                Modifier le post
                                            </a>
                                            <form action="{{ route('feed.destroy', $post->id) }}" method="POST" class="w-full m-0">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')" class="flex items-center w-full px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">
                                                    <svg class="mr-3 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Supprimer le post
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Text -->
                            <div class="px-4 pb-2 pt-1">
                                <p class="text-gray-900 text-[15px] leading-relaxed whitespace-pre-wrap break-words">{{ $post->content }}</p>
                            </div>

                            <!-- Content Image -->
                            @if($post->photo)
                            <div class="w-full bg-gray-50">
                                <img src="{{ asset('photos/' . $post->photo) }}" alt="Post image" class="w-full max-h-[500px] object-contain">
                            </div>
                            @endif

                            <!-- Interactions Meta (Like/Comment Counts) -->
                            <div class="px-4 py-2 flex items-center justify-between text-xs text-gray-500 border-b border-gray-100 mt-1">
                                <div class="flex items-center gap-1">
                                    @if ($post->likes->count() > 0)
                                        <div class="relative flex items-center">
                                            <img class="w-4 h-4 rounded-full border border-white z-10 relative" src="https://static.licdn.com/aero-v1/sc/h/8ekq8gho1ruaf8i7f86vd1ftt" alt="Like">
                                        </div>
                                        <span class="hover:text-blue-700 hover:underline cursor-pointer ml-1">{{ $post->likes->count() }}</span>
                                    @endif
                                </div>
                                @if($post->comments->count() > 0)
                                <div class="hover:text-blue-700 hover:underline cursor-pointer">
                                    {{ $post->comments->count() }} commentaire{{ $post->comments->count() > 1 ? 's' : '' }}
                                </div>
                                @endif
                            </div>

                            <!-- Actions Bar (Like, Comment, Share) -->
                            <div class="px-2 py-1 flex justify-around items-center">
                                @php $hasLiked = $post->likes->contains('user_id', auth()->id()); @endphp

                                <!-- Like Form -->
                                <form action="{{ route('feed_like.store') }}" method="POST" class="flex-1 m-0">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 rounded-md transition-colors text-sm font-semibold {{ $hasLiked ? 'text-[#0a66c2] hover:bg-blue-50' : 'text-gray-500 hover:bg-gray-100' }}">
                                        @if($hasLiked)
                                            <!-- Liked Icon (Filled) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M1 19V9h4v10H1zm22-4.5c0 1.25-.8 2.34-1.97 2.47l-6.19.74c-.58.07-1.12.35-1.53.8l-1.8 1.93c-.23.25-.56.36-.9.36-.6 0-1.1-.47-1.17-1.07l-.3-2.61c-.08-.75-.43-1.44-.98-1.95L4.5 12V9.5l6.45-6.2c.42-.4.99-.61 1.58-.58L16 3c1.1 0 2 .9 2 2v2.5h2.5c1.1 0 2 .9 2 2v5z"></path></svg>
                                            <span>J'aime</span>
                                        @else
                                            <!-- Unliked Icon (Outline) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M19.46 11l-3.91-3.91a1.54 1.54 0 01-.46-1V4a2 2 0 00-2-2h-1.47a2.5 2.5 0 00-1.56.54l-7.13 5.46a1.5 1.5 0 00-.53 1.2v7.1a1.5 1.5 0 00.53 1.2l7.13 5.46a2.5 2.5 0 001.56.54h1.47a2 2 0 002-2v-2.09a1.54 1.54 0 01.46-1l3.91-3.91a2 2 0 000-2.82zM15 18a1 1 0 01-1 1h-1.47a1.5 1.5 0 01-.94-.32l-7-5.36v-6.64l7-5.36a1.5 1.5 0 01.94-.32H14a1 1 0 011 1v2.09c0 .79.31 1.55.88 2.11l3.54 3.54a1 1 0 010 1.42l-3.54 3.54a2.98 2.98 0 00-.88 2.11V18z"></path><path d="M3 8H1v12h2V8z"></path></svg>
                                            <span>J'aime</span>
                                        @endif
                                    </button>
                                </form>

                                <button class="flex-1 btn-comment flex items-center justify-center gap-2 py-3 text-gray-500 hover:bg-gray-100 font-semibold rounded-md transition-colors text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M7 9h10v1H7zm0 4h7v-1H7zm16-2a6.78 6.78 0 01-2.84 5.61L12 22v-4H8A7 7 0 018 4h8a7 7 0 017 7zm-2 0a5 5 0 00-5-5H8a5 5 0 000 10h6v2.28L19 15a4.79 4.79 0 002-4z"></path></svg>
                                    <span>Commenter</span>
                                </button>
                                <button class="flex-1 flex items-center justify-center gap-2 py-3 text-gray-500 hover:bg-gray-100 font-semibold rounded-md transition-colors text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M21 3L0 10l7.66 4.26L16 8l-6.26 8.34L14 24l7-21z"></path></svg>
                                    <span>Partager</span>
                                </button>
                            </div>

                            <!-- Comment Area (Hidden initially) -->
                            <div class="comment-area px-4 pb-4 hidden transition-all duration-300">
                                <form action="{{ route('feed_comment.store') }}" method="POST" class="mt-1 mb-4">
                                    @csrf
                                    <div class="flex gap-2 items-start">
                                        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                                            alt="Avatar" class="w-10 h-10 rounded-full object-cover shrink-0 mt-0.5">
                                        <div class="flex-1 flex flex-col items-end">
                                            <textarea name="content" rows="1" required
                                                class="w-full border border-gray-400 text-sm rounded-full focus:ring-1 focus:ring-gray-500 focus:border-gray-500 py-2.5 px-4 placeholder-gray-500 resize-none transition-all shadow-sm"
                                                placeholder="Ajouter un commentaire..."
                                                oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, 150) + 'px'; this.classList.remove('rounded-full'); this.classList.add('rounded-xl'); if(this.value === '') { this.classList.add('rounded-full'); this.classList.remove('rounded-xl'); }"
                                                ></textarea>
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button type="submit" class="mt-2 bg-[#0a66c2] hover:bg-[#004182] text-white font-semibold py-1.5 px-4 rounded-full text-sm transition shadow-sm">
                                                Publier
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Comments List -->
                                <div class="space-y-4">
                                    @foreach ($post->comments as $comment)
                                        <div class="flex gap-2 items-start">
                                            <img src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=random' }}"
                                                alt="Avatar" class="w-10 h-10 rounded-full object-cover mt-0.5 shrink-0 hover:opacity-80 cursor-pointer">

                                            <div class="flex-1">
                                                <div class="bg-[#f2f2f2] px-3.5 py-2.5 rounded-br-xl rounded-bl-xl rounded-tr-xl inline-block w-full">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <h4 class="font-bold text-gray-900 text-sm hover:text-blue-700 hover:underline cursor-pointer leading-tight">
                                                                {{ $comment->user->name }}
                                                            </h4>
                                                            <p class="text-xs text-gray-500 mb-1 leading-tight line-clamp-1">{{ $comment->user->headline ?? 'Membre' }}</p>
                                                        </div>
                                                        <span class="text-xs text-gray-500 shrink-0 ml-4">{{ $comment->created_at->diffForHumans(null, true, true) }}</span>
                                                    </div>
                                                    <p class="text-gray-900 text-sm leading-snug whitespace-pre-wrap break-words mt-1">{{ $comment->content }}</p>
                                                </div>

                                                <!-- Comment Meta Actions -->
                                                <div class="flex items-center gap-4 mt-1 ml-3 text-xs font-semibold text-gray-500">
                                                    <button class="hover:bg-gray-200 px-2 py-0.5 rounded transition">J'aime</button>
                                                    <span class="text-gray-300">|</span>
                                                    @if ($comment->user_id == auth()->id())
                                                        <a href="{{ route('feed_comment.edit', $comment->id) }}" class="hover:bg-gray-200 px-2 py-0.5 rounded transition">Modifier</a>
                                                        <span class="text-gray-300">|</span>
                                                        <form action="{{ route('feed_comment.destroy', $comment->id) }}" method="POST" class="inline m-0">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Supprimer ce commentaire ?')" class="hover:bg-red-50 hover:text-red-600 px-2 py-0.5 rounded transition">Supprimer</button>
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
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 3v5h5"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Votre fil d'actualité est vide</h3>
                            <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Partagez vos pensées, idées ou articles avec votre réseau professionnel.</p>
                            <a href="{{ route('feed.create') }}" class="inline-flex justify-center px-6 py-2.5 bg-[#0a66c2] border border-transparent shadow-sm text-sm font-medium rounded-full text-white hover:bg-[#004182] transition-colors">
                                Rédiger un post
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Sidebar (Suggestions - Hidden on Mobile/Tablet) -->
            <div class="hidden lg:block lg:col-span-3 space-y-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <h2 class="font-semibold text-gray-900 text-base mb-4">Ajouter à votre fil d'actualité</h2>

                    <div class="space-y-4">
                        <!-- Suggestion Item Placeholder -->
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-full bg-gray-200 shrink-0"></div>
                            <div>
                                <h4 class="font-semibold text-sm text-gray-900 leading-tight">Entreprise X</h4>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">Technologie de l'information et services</p>
                                <button class="mt-2 flex items-center justify-center gap-1 border border-gray-600 text-gray-600 hover:bg-gray-100 hover:border-gray-900 hover:text-gray-900 font-semibold text-sm px-4 py-1 rounded-full transition-colors">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M14 12L8 3v18l6-9z"></path></svg>
                                    Suivre
                                </button>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-12 h-12 rounded-full bg-gray-200 shrink-0"></div>
                            <div>
                                <h4 class="font-semibold text-sm text-gray-900 leading-tight">Personne Y</h4>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">Développeur Full Stack | Laravel | Vue.js</p>
                                <button class="mt-2 flex items-center justify-center gap-1 border border-gray-600 text-gray-600 hover:bg-gray-100 hover:border-gray-900 hover:text-gray-900 font-semibold text-sm px-4 py-1 rounded-full transition-colors">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M14 12L8 3v18l6-9z"></path></svg>
                                    Suivre
                                </button>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="inline-flex items-center gap-1 mt-4 text-sm font-semibold text-gray-600 hover:bg-gray-100 px-2 py-1 rounded transition">
                        Voir toutes les suggestions
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Footer Links -->
                <div class="text-center px-4">
                    <ul class="flex flex-wrap justify-center gap-x-3 gap-y-1 text-xs text-gray-500">
                        <li><a href="#" class="hover:text-blue-600 hover:underline">À propos</a></li>
                        <li><a href="#" class="hover:text-blue-600 hover:underline">Accessibilité</a></li>
                        <li><a href="#" class="hover:text-blue-600 hover:underline">Assistance</a></li>
                        <li><a href="#" class="hover:text-blue-600 hover:underline">Confidentialité et conditions</a></li>
                        <li><a href="#" class="hover:text-blue-600 hover:underline">Préférences publicitaires</a></li>
                    </ul>
                    <p class="text-xs text-gray-500 mt-2">ProfessionalConnect Corporation © 2026</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts for Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dropdown Menu Logic
            const dropdownBtns = document.querySelectorAll('.dropdown-btn');

            dropdownBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent document click from immediately closing it
                    const menu = btn.nextElementSibling;
                    const isCurrentlyHidden = menu.classList.contains('hidden');

                    // Close all other dropdowns first
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        m.classList.add('hidden');
                    });

                    // Toggle current
                    if (isCurrentlyHidden) {
                        menu.classList.remove('hidden');
                    }
                });
            });

            // Close dropdowns when clicking anywhere outside
            document.addEventListener('click', () => {
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    m.classList.add('hidden');
                });
            });

            // Comment Toggle Logic
            const commentBtns = document.querySelectorAll('.btn-comment');
            commentBtns.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    const commentAreas = document.querySelectorAll('.comment-area');
                    const area = commentAreas[index];

                    area.classList.toggle('hidden');

                    // Optional: focus the textarea when opened
                    if (!area.classList.contains('hidden')) {
                        const textarea = area.querySelector('textarea');
                        if(textarea) textarea.focus();
                    }
                });
            });
        });
    </script>
</x-app-layout>

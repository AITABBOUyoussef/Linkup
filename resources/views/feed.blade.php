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
                                    <a href="{{ route('feed.edit', $post->id) }}" class="text-gray-400 hover:text-blue-600 text-sm">Edit</a>
                                    <form action="{{ route('feed.destroy', $post->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer ce post ?')" class="text-gray-400 hover:text-red-600 text-sm">Delete</button>
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
                            <button class="text-sm text-gray-600 font-medium hover:text-blue-600 transition">J'aime</button>
                            <button class="text-sm text-gray-600 font-medium hover:text-blue-600 transition">Commenter</button>
                            <button class="text-sm text-gray-600 font-medium hover:text-blue-600 transition">Partager</button>
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
</x-app-layout>

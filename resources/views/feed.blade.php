
<x-app-layout>



    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-700">Fil d'actualité</h2>
        <p class="text-sm text-gray-500">Découvrez les dernières publications de votre réseau.</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-8 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
            <img src="https://ui-avatars.com/api/?name=Moi&background=0D8ABC&color=fff" alt="Mon Avatar" class="w-full h-full object-cover">
        </div>

        <a href="{{ route('feed.create') }}" class="flex-grow bg-gray-100 hover:bg-gray-200 text-gray-500 text-left rounded-full py-3 px-5 transition duration-200 font-medium border border-gray-300 shadow-inner">
            Commencer un post...
        </a>
    </div>

    @foreach ($posts as $post)
        <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 mb-5">

            <div class="flex items-center mb-4">
                <img src="{{ $post->user->image_url }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover mr-4">
                <div>
                    <h3 class="font-bold text-gray-900 text-md">{{ $post->user->name }}</h3>
                    <p class="text-gray-500 text-xs">
                        {{ $post->user->headline }}
                        @if($post->user->company)
                            chez {{ $post->user->company }}
                        @endif
                    </p>
                    <p class="text-gray-400 text-xs mt-0.5">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="text-gray-800 leading-relaxed">
                {{ $post->content }}
            </div>
            <tr>
                 <td>
                    @if ($post->user_id==auth()->id())


                        <a href="{{ route('feed.edit', $post->id) }}" class="btn btn-warning bg-green-200 rounded-3xl p-1 m-1">Modifier</a>
 <form action="{{ route('feed.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-red-300 rounded-3xl p-1 m-1"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Post ?')">Supprimer</button>
                        </form>
                    </td>
                     @endif
                     <div></div>
            </tr>


</div>
    @endforeach



</x-app-layout>

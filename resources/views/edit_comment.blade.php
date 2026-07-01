<x-app-layout>
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <a href="{{ route('feed.index') }}" class="text-blue-600 hover:underline text-sm font-semibold flex items-center mb-4">
            &larr; Retour au fil d'actualité
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Modifier votre commentaire</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">

        <form action="{{ route('feed_comment.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Votre commentaire</label>

                <textarea name="content" id="content" rows="4"
                          class="w-full bg-gray-50 border @error('content') border-red-500 @else border-gray-300 @enderror text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-4 resize-none"
                          required>{{ $comment->content }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-full transition duration-150 shadow-sm">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>

</div>
</x-app-layout>

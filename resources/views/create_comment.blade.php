<x-app-layout>
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="/feed" class="text-blue-600 hover:underline text-sm font-semibold flex items-center mb-4">
            &larr; Retour au fil d'actualité
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Créer un nouveau comment</h2>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

        <form action="{{ route('commant.store',$post) }}" method="POST">

            @csrf

            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">De quoi souhaitez-vous discuter ?</label>

                <textarea name="content" id="content" rows="5"
                          class="w-full bg-gray-50 border @error('content') border-red-500 @else border-gray-300 @enderror text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-4 placeholder-gray-400 resize-none"
                          placeholder="Partagez vos idées avec votre réseau..."></textarea>

                {{-- @error('content')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror --}}
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-full transition duration-200 ease-in-out shadow">
                    Publier
                </button>
            </div>
        </form>
    </div>

</div>
</x-app-layout>

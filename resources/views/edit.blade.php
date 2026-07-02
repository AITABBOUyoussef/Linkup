<x-app-layout>
<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="/feed" class="text-blue-600 hover:underline text-sm font-semibold flex items-center mb-4">
            &larr; Retour au fil d'actualité
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Créer un nouveau post</h2>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">

        <form action="{{ route('feed.update',$post->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
 @method('PUT')
            <div class="mb-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">De quoi souhaitez-vous discuter ?</label>

                <textarea name="content"  id="content" rows="5"
                          class="w-full bg-gray-50 border @error('content') border-red-500 @else border-gray-300 @enderror text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-4 placeholder-gray-400 resize-none"
                          required>{{  $post->content }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
  <div class="flex items-center justify-between mt-3 -mb-1">
                    <button
                        class="flex items-center gap-1.5 text-gray-500 hover:bg-gray-100 px-2 sm:px-3 py-2 rounded-lg transition text-[14px] font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                         <label for="photo">Photo</label>
                         <input type="file" name="photo" class="form-control">
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
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-full transition duration-200 ease-in-out shadow">
                    Publier
                </button>
            </div>
        </form>
    </div>

</div>
</x-app-layout>

@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-700">Fil d'actualité</h2>
        <p class="text-sm text-gray-500">Découvrez les dernières publications de votre réseau.</p>
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

        </div>
    @endforeach

@endsection

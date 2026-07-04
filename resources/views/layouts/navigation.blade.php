<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-[1128px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[52px]">
            <!-- Left Side: Logo & Search -->
            <div class="flex items-center gap-2">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('feed.index') }}" class="transition transform hover:scale-105">
                        <svg viewBox="0 0 24 24" class="w-10 h-10 text-[#0a66c2] fill-current" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 118.3 6.5a1.78 1.78 0 01-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0013 14.19a.66.66 0 000 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 012.7-1.4c1.55 0 3.36.86 3.36 3.66z"></path>
                        </svg>
                    </a>
                </div>
                <div class="hidden sm:flex items-center ml-4">
                    <form action="{{ route('network.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="block w-64 pl-10 pr-3 py-1.5 border border-transparent rounded-md bg-[#EEF3F8] text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-gray-300 transition-all duration-300 focus:w-80"
                               placeholder="Recherche...">
                    </form>
                </div>
            </div>

            <!-- Right Side: Icons -->
            <div class="hidden sm:flex sm:items-center h-full">
                <a href="{{ route('feed.index') }}" class="flex flex-col items-center justify-center w-16 h-full text-gray-500 hover:text-black {{ request()->routeIs('feed.index') ? 'border-b-2 border-black text-black' : '' }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-[10px] mt-0.5">Accueil</span>
                </a>

                <a href="{{ route('network.index') }}" class="flex flex-col items-center justify-center w-16 h-full text-gray-500 hover:text-black {{ request()->routeIs('network.index') ? 'border-b-2 border-black text-black' : '' }}">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-[10px] mt-0.5">Réseau</span>
                </a>

                <!-- Profile Dropdown -->
                <div class="ml-4 relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-col items-center text-gray-500 hover:text-black">
                        <img class="h-6 w-6 rounded-full border border-gray-300" src="{{ auth()->user()->avatar_url }}" alt="Me">
                        <span class="text-[10px] mt-0.5">Vous</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Voir le profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

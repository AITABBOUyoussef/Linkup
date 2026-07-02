<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-[1128px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[52px]">
            <!-- Left Side: Logo & Search -->
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('feed.index') }}" class="transition transform hover:scale-105 active:scale-95">
                        <svg viewBox="0 0 24 24" class="w-10 h-10 text-[#0a66c2] fill-current" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 118.3 6.5a1.78 1.78 0 01-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0013 14.19a.66.66 0 000 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 012.7-1.4c1.55 0 3.36.86 3.36 3.66z"></path>
                        </svg>
                    </a>
                </div>

                <!-- Search Bar (Hidden on mobile) -->
                <div class="hidden lg:flex items-center">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500 group-focus-within:text-gray-700 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                               class="block w-64 pl-10 pr-3 py-1.5 border border-transparent rounded-sm bg-[#eef3f8] text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:w-80 focus:border-gray-300 focus:bg-white transition-all duration-300"
                               placeholder="Recherche">
                    </div>
                </div>
            </div>

            <!-- Right Side: Navigation Icons -->
            <div class="hidden sm:flex sm:items-center h-full">
                <!-- Accueil -->
                <a href="{{ route('feed.index') }}" class="flex flex-col items-center justify-center w-20 h-full border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('feed.index') ? 'border-[#191919] text-[#191919]' : 'border-transparent text-gray-500 hover:text-[#191919]' }}">
                    <svg class="w-6 h-6" fill="{{ request()->routeIs('feed.index') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-[12px] mt-0.5 hidden md:block {{ request()->routeIs('feed.index') ? 'font-medium' : '' }}">Accueil</span>
                </a>

                <!-- Réseau -->
                <a href="#" class="flex flex-col items-center justify-center w-20 h-full border-b-2 border-transparent text-gray-500 hover:text-[#191919] transition duration-150 ease-in-out">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="text-[12px] mt-0.5 hidden md:block">Réseau</span>
                </a>

                <!-- Diviseur -->
                <div class="h-8 w-[1px] bg-gray-200 mx-2 hidden lg:block"></div>

                <!-- Profile Dropdown -->
                <div class="flex items-center h-full relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex flex-col items-center justify-center w-20 h-full text-gray-500 hover:text-[#191919] focus:outline-none transition duration-150 ease-in-out">
                        <img class="h-6 w-6 rounded-full object-cover border border-gray-300" src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" alt="Profile">
                        <div class="hidden md:flex items-center mt-0.5 text-[12px]">
                            <span>Vous</span>
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 top-full mt-1 w-64 bg-white rounded-lg shadow-xl border border-gray-200 z-50 hidden" :class="{'hidden': !dropdownOpen}">
                        <div class="p-4 border-b border-gray-100 flex items-start gap-3">
                            <img class="h-12 w-12 rounded-full object-cover" src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" alt="Profile">
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500 truncate leading-tight mt-0.5">{{ Auth::user()->headline ?? 'Membre' }}</p>
                            </div>
                        </div>
                        <div class="p-2 border-b border-gray-100">
                            <a href="{{ route('profile.edit') }}" class="block w-full text-center px-4 py-1 text-sm text-blue-600 font-semibold border border-blue-600 rounded-full hover:bg-blue-50 transition">Voir le profil</a>
                        </div>
                        <div class="p-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md transition">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200 bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('feed.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('feed.index') ? 'border-blue-600 text-blue-700 bg-blue-50' : 'border-transparent text-gray-600 hover:bg-gray-50' }} text-base font-medium transition">Accueil</a>
            <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium transition">Voir le profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium transition">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>

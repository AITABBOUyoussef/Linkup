<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <!-- Left Side: Logo & Search -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('feed.index') }}" class="flex items-center gap-1 transition transform hover:scale-105">
                        <div class="bg-blue-600 text-white p-1 rounded font-bold text-xl leading-none flex items-center justify-center w-8 h-8">
                            in
                        </div>
                    </a>
                </div>

                <!-- Search Bar (Hidden on very small screens) -->
                <div class="hidden sm:flex items-center ml-4">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                               class="block w-64 pl-10 pr-3 py-1.5 border border-transparent rounded-md leading-5 bg-[#EEF3F8] text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white focus:border-gray-300 focus:ring-0 sm:text-sm transition-all duration-300 ease-in-out focus:w-80"
                               placeholder="Recherche...">
                    </div>
                </div>
            </div>

            <!-- Right Side: Navigation Icons & Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 h-full space-x-1 md:space-x-4">

                <!-- Icon: Accueil -->
                <a href="{{ route('feed.index') }}"
                   class="flex flex-col items-center justify-center w-16 h-full border-b-2 transition duration-150 ease-in-out {{ request()->routeIs('feed.index') ? 'border-black text-black' : 'border-transparent text-gray-500 hover:text-black' }}">
                    <svg class="w-6 h-6" fill="{{ request()->routeIs('feed.index') ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-[10px] hidden md:block mt-0.5 font-medium">Accueil</span>
                </a>

                <!-- Icon: Réseau (Placeholder) -->
                <a href="#" class="flex flex-col items-center justify-center w-16 h-full border-b-2 border-transparent text-gray-500 hover:text-black transition duration-150 ease-in-out">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="text-[10px] hidden md:block mt-0.5 font-medium">Réseau</span>
                </a>

                <!-- Icon: Emplois (Placeholder) -->
                <a href="#" class="flex flex-col items-center justify-center w-16 h-full border-b-2 border-transparent text-gray-500 hover:text-black transition duration-150 ease-in-out">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-[10px] hidden md:block mt-0.5 font-medium">Emplois</span>
                </a>

                <!-- Diviseur vertical -->
                <div class="h-8 w-px bg-gray-200 mx-2 hidden md:block"></div>

                <!-- Settings Dropdown -->
                <div class="flex items-center h-full">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex flex-col items-center justify-center w-12 h-full text-gray-500 hover:text-black focus:outline-none transition duration-150 ease-in-out">
                                <img class="h-6 w-6 rounded-full object-cover border border-gray-200"
                                     src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}"
                                     alt="Profile">
                                <div class="hidden md:flex items-center mt-0.5">
                                    <span class="text-[10px] font-medium">Vous</span>
                                    <svg class="fill-current h-3 w-3 ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->headline ?? 'Membre' }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="font-medium mt-1">
                                {{ __('Voir le profil') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100 mt-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-red-600 hover:text-red-700">
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">

        <!-- Mobile Search (Visible only on mobile when menu opens) -->
        <div class="p-4 border-b border-gray-200">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-[#EEF3F8] text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white focus:border-blue-500 sm:text-sm" placeholder="Recherche...">
            </div>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('feed.index')" :active="request()->routeIs('feed.index')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Réseau') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Emplois') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex items-center gap-3 mb-3">
                <img class="h-10 w-10 rounded-full object-cover border border-gray-200"
                     src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}"
                     alt="Profile">
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->headline ?? Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Voir le profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-600">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

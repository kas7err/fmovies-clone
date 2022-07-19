<div>
    <nav class="theme-bg">
        <div class="max-w-screen-2xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-24">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed.
                        Heroicon name: outline/menu
                        Menu open: "hidden", Menu closed: "block"-->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open.
                        Heroicon name: outline/x
                        Menu open: "block", Menu closed: "hidden"-->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-between sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto" src="/images/fmovies.png" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto" src="/images/fmovies.png" alt="Workflow">
                    </div>
                    <div class="hidden sm:block sm:ml-10">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-400 hover:bg-gray-700 hover:text-white" -->
                            <a href="/" class="text-gray-400 px-2 py-2 rounded-md text-sm font-medium"
                                aria-current="page">Home</a>
                            <div x-data="{ open: false }" @mouseover="open = true" class="items-center my-auto">
                                <a href="#" @click.prevent=""
                                    class="text-gray-400 hover:text-blue-300 px-2 py-2 rounded-md text-sm font-medium">Genre

                                </a>
                                <div x-cloak @mouseout.away="open = false" :class="{'hidden': !open}"
                                    class="absolute mt-1 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-x-6 gap-y-1 bg-gray-800 py-5 px-5 rounded-md z-10">
                                    @foreach ($genres as $genre)
                                        <a class="text-gray-400 hover:bg-gray-600 rounded-md m-0 p-1 text-sm "
                                            href="/genre/{{ Str::lower($genre->title) }}">{{ $genre->title }}</a>
                                    @endforeach
                                </div>
                            </div>


                            <a href="/movies"
                                class="text-gray-400 hover:text-blue-300 px-2 py-2 rounded-md text-sm font-medium">Movies</a>

                            <a href="/series"
                                class="text-gray-400 hover:text-blue-300 px-2 py-2 rounded-md text-sm font-medium">TV-Series</a>

                            <a href="/top-imdb"
                                class="text-gray-400 hover:text-blue-300 px-2 py-2 rounded-md text-sm font-medium">Top
                                IMDb</a>
                        </div>
                    </div>
                    <div class="sm:ml-14">
                        @livewire('search')
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-400 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                    aria-current="page">Home</a>
                <a href="#"
                    class="text-gray-400 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Genre</a>

                <a href="#"
                    class="text-gray-400 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Movies</a>

                <a href="/series"
                    class="text-gray-400 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">TV-Series</a>

                <a href="#"
                    class="text-gray-400 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">imdb
                    Top 250</a>
            </div>
        </div>
    </nav>
</div>

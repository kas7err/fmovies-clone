<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fmovies Clone</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles()
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    @livewire('navigation')

    <div id="content">
        @yield('content')
    </div>

    <footer class="theme-bg text-gray-400">
        <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto  lg:justify-between">
            <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4">
                    <a href="/">
                        <li>Home</li>
                    </a>
                    <a href="/movies">
                        <li>Movies</li>
                    </a>
                    <a href="/series">
                        <li>Series</li>
                    </a>
                    <a href="/genre/horror">
                        <li>Horror</li>
                    </a>
                    <a href="/genre/comedy">
                        <li>Comedy</li>
                    </a>
                    <a href="/genre/thriller">
                        <li>Thriller</li>
                    </a>
                    <a href="/top-imdb">
                        <li>Top IMDb</li>
                    </a>
                </ul>
            </div>
            <div class="flex justify-center mt-4 lg:mt-0">
                <a>
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    @livewireScripts
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(".showInfo").on('mouseover', function() {
            let tooltip = $(this).next() //
            let ww = $(window).outerWidth(),
                offset = $(this).offset(),
                tl = offset.left,
                tw = tooltip.outerWidth() + 200;

            tooltip.css({
                'left': '180px',
                'right': 0,
                'top': '25px'
            });

            if ((tl + tw) > ww) tooltip.css({
                'left': '-270px'
            });
        })
    </script>
</body>

</html>

@extends('layouts.index')
@section('content')
    <div class="container mx-auto flex flex-col md:flex-row items-center"
            x-data="{
                data:{},
                loading:true,
                formatBio: (text) => {
                    return text.substring(0, 500) + (text.length > 500 ? ' ...' : '');
                }
            }"
            x-init="(async () => {
                const response = await fetch('/api/actor/{!! $id !!}')
                if (! response.ok) alert(`Something went wrong: ${response.status} - ${response.statusText}`)
                data = await response.json()
                loading = !loading
                })()">
        <div class="flex w-full mt-10" :class="{'hidden': !loading}" style="height: 200px;">
            <div class="tenor-gif-embed" data-postid="15269201" data-share-method="host" data-aspect-ratio="1"
                data-width="100%"><a href="https://tenor.com/view/loading-cargando-gif-15269201">Loading Cargando
                    Sticker</a>from <a href="https://tenor.com/search/loading-stickers">Loading Stickers</a></div>
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </div>
        <div class="flex w-full mt-10" :class="{'hidden': loading}">
            <img :src="data.poster" alt="" class="max-w-fit w-80 rounded-md max-h-96" style="object-fit:cover;">
            <div class="info-wrapper w-9/12 my-auto md:pl-10">
                <h1 class="font-bold logo-bg text-5xl my-4" x-text="data.name"></h1>
                <div class="wrapper-bio">
                    <p x-text="formatBio(data.bio)" class="leading-normal mb-4 max-w-xl text-gray-500">..</p>
                </div>
                <div
                    class=" grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 gap-x-3 gap-y-3">
                    <template x-for="photo in data.photos">
                        <img class="w-full h-48 rounded-md" :src="photo" :alt="data.name">
                    </template>
                </div>
                <p class="flex my-2">
                    <template x-for="award in data.awards">
                        <div class="wrapper-bio">
                            <p x-html="award"></p>
                        </div>
                    </template>
                </p>
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-10 mb-5">
        <h3 class="logo-bg text-4xl font-bold ">Movies: </h3>
    </div>
    <div class="container mx-auto flex  items-center mb-10">

        <div class="flex flex-wrap  items-center align-middle text-gray-600 text-sm">

            <div
                class=" grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-x-3 gap-y-4">
                @foreach ($movies as $tv)
                    <div class=" relative rounded shadow-lg text-white " x-data="{movie: {{ $tv }},
            movieInfo: false,
            ploatLength: 150,
            listGenres: function(string, length, index) {
                if (length === index + 1) return `&nbsp; ${string}`;
                return `&nbsp; ${string},`
            },
            rating: function(ratig) {
                let html = `<svg xmlns='http://www.w3.org/2000/svg' class='h-4 w-4 mr-2 logo-bg' fill='currentColor'
        viewBox='0 0 24 24' stroke='currentColor'>
        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
            d='M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z' />
        </svg>`
                return html + ratig;
            }
        }">
                        <a href="{{ route('title', $tv) }}" @mouseover="movieInfo = true"
                            class="showInfo"><img class="w-full h-60 rounded-md" src="{{ $tv->poster_url }}"
                                alt="{{ $tv->title }}">

                        </a>
                        <div x-cloak x-show="movieInfo" @mouseout.away="movieInfo = false"
                            class="absolute  bg-gray-800 py-3 px-3 rounded-md z-10 w-64 max-w-64 max-h-96">
                            <h4 class="text-md text-bold" x-text="movie.title"></h4>
                            <div class="flex justify-between items-center text-gray-400 text-xs pr-5 py-1">

                                <p x-html="rating(movie.rating)" class="text-gray-300 flex"></p>
                                <p x-text="movie.year"></p>
                                <p x-text="movie.length"></p>
                            </div>

                            <p class="text-sm text-gray-400 my-2" x-text="movie.plot.substring(0, ploatLength) +'...'"></p>

                            <div class="flex flex-wrap items-center text-gray-400 text-xs pr-5">
                                <p>Genre: </p>
                                <template x-for="(genre, index) of movie.genres" :key="genre.id">
                                    <p x-text="listGenres(genre.title, movie.genres.length, index)" class="text-gray-200 ">
                                    </p>
                                </template>
                            </div>
                        </div>

                        <div class="p-1">
                            <div class="text-sm text-gray-700">{{ Str::limit($tv->title, 19) }}</div>
                            <div class="flex justify-between items-center text-gray-400">
                                <span class="text-xs ">{{ $tv->year }} &nbsp; <small
                                        style="font-size:28px;">.</small>&nbsp;
                                    {{ $tv->length }}</span>
                                <span class="border rounded-sm"
                                    style="padding:3px 3px 1px 3px;font-size:10px;">{{ $tv->type }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

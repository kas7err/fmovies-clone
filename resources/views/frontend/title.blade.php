@extends('layouts.index')

@section('content')
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <div class="flex w-full mt-10">
            <img src="{{ $movie->poster_url }}" alt="" class="max-w-fit w-96 rounded-md" style="object-fit:cover;">
            <div class="info-wrapper w-9/12 my-auto md:pl-10">
                <iframe
                    src="{{ 'http://www.imdb.com/video/imdb/' . json_decode($movie->trailer)->id . '/imdb/embed?autoplay=true&ref_=tt_ov_vi' }}"
                    style="overflow:hidden;height:400px;width:100%" height="100%" width="100%" allowfullscreen="true"
                    mozallowfullscreen="true" webkitallowfullscreen="true" class="w-full mb-4" frameborder="no"
                    scrolling="no"></iframe>

                <div class="flex justify-start items-center align-middle text-gray-600 text-sm">
                    <p class=" flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                            fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>{{ $movie->rating }}&nbsp;&nbsp;</p>
                    <span class="text-black align-middle" style="font-size:25px;padding-bottom:12px;">.</span>
                    <p>&nbsp;&nbsp;{{ $movie->year }}&nbsp;&nbsp;</p>
                    <span class="text-black align-middle" style="font-size:25px;padding-bottom:12px;">.</span>
                    <p>&nbsp;&nbsp;{{ $movie->length }}</p>
                    <div x-data="{ movie: {{ $movie }}, 
                                                        listGenres: function(string, length, index) {
                                                            if (length === index + 1) return `&nbsp; ${string}`;
                                                            return `&nbsp; ${string},`
                                                        }}" class="flex flex-wrap items-center text-gray-800 text-sm pl-5">
                        <p class="font-bold">Genre: </p>
                        <template x-for="(genre, index) of movie.genres" :key="genre.id">
                            <p x-text="listGenres(genre.title, movie.genres.length, index)">
                            </p>
                        </template>
                    </div>
                </div>
                <h1 class="font-bold logo-bg text-5xl my-4">{{ $movie->title }}</h1>
                <p class="leading-normal mb-4 max-w-xl text-gray-400">{{ $movie->plot }}</p>
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-6 mb-6">
        <h3 class="logo-bg text-4xl font-bold ">Cast: </h3>
    </div>
    <div class="container mx-auto flex  items-center mb-10">

        <div class="flex flex-wrap  items-center align-middle text-gray-600 text-sm">

            <div class="grid grid-cols-5 gap-4 mx-auto">
                @foreach (json_decode($movie->cast) as $cast)
                    <a href="{{ route('showActor', $cast->actor_id) }}">
                        <div class="flex items-center align-middle">

                            <img src="{{ $cast->avatar }}" class="rounded-full" style="object-fit:cover;" alt="">
                            <div class="ml-2">
                                <p class="text-md font-bold text-blue-900">{{ $cast->actor }}</p>
                                <p>{{ $cast->character }}</p>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

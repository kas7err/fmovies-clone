<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use hmerritt\Imdb;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    // $imdb = new Imdb;
    // $actor = $imdb->actor("nm0000093", ['cache' => false]);
    // dd($actor);
    return view('index');
});

Route::get('/actor/{id}', function ($id) {
    $imdb = new Imdb;
    $actor = $imdb->actor($id, ['cache' => true]);
    return response()->json($actor);
});

Route::get('/name/{id}', function ($id) {
    Cache::rememberForever($id, function () use ($id) {
        return Movie::with('genres')->whereJsonContains('cast', ['actor_id' => $id])->get();
    });
    $movies = Cache::pull($id);
    return view('frontend.actor', ['id' => $id,  'movies' => $movies]);
})->name('showActor');

Route::get('/title/{slug}', function ($slug) {
    $movie = Movie::with('genres')->where('slug', $slug)->first();
    return view('frontend.showTitle', ['movie' => $movie]);
})->name('showTitle');

Route::get('/movies', function () {
    $gridData = ['title' => 'Movies', 'type' => 'Movie'];
    return view('frontend.movies', ['gridData' => $gridData]);
});

Route::get('/series', function () {
    $gridData = ['title' => 'TV Series', 'type' => 'TV'];
    return view('frontend.series', ['gridData' => $gridData]);
});

Route::get('/filter', function (Request $request) {
    $gridData = ['title' => 'Filter Movies', 'filter' => $request->query()];
    return view('frontend.filter', ['gridData' => $gridData]);
});

Route::get('/genre/{title}', function ($title) {
    $gridData = ['title' => ucfirst($title) . ' Movies, TV Shows', 'genre' => $title];
    return view('frontend.genre', ['gridData' => $gridData]);
});

Route::get('/search', function (Request $request) {
    $gridData = ['title' => "Result form: $request->q", 'search' => true];
    return view('frontend.search', ['gridData' => $gridData]);
});

Route::get('/top-imdb', function (Request $request) {
    $gridData = ['title' => "Top IMDb", 'imdb' => true];
    return view('frontend.top-imdb', ['gridData' => $gridData]);
});

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
    });

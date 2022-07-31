<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use hmerritt\Imdb;
use Illuminate\Support\Facades\Cache;
use Goutte\Client;


Route::get('/', function () {
    return view('index');
});

Route::get('/actor/{id}', function ($id) {

    $client = new Client();
    $crawler = $client->request('GET', "https://www.imdb.com/name/". $id ."/");

    $actor = [];
    $actor["name"] = "";
    $actor["bio"] = [];
    $actor["poster"] = "";
    $actor["photos"] = [];
    $actor["awards"] = "";

    $name = $crawler->filter('h1.header span');
    if($name->count() > 0) {
        $actor['name'] = $name->text();
    }

    $poster = $crawler->filter("img#name-poster");
    if ($poster->count() > 0) {
        $actor["poster"] = $poster->attr("src");
    }

    $bio = $crawler->filter("#name-bio-text .inline");
    if ($bio->count() > 0) {
        $actor["bio"]['text'] = $bio->text();
        $actor["bio"]['born'] = $crawler->filter("#name-born-info")->outerHtml();
    }

    $photos = $crawler->filter(".mediastrip a > img");
    if ($photos->count() > 0) {
        $photos->each(function ($node) use(&$actor){
            $actor['photos'][] = $node->attr('loadlate');
        });
    }

    $awards = $crawler->filter("span.awards-blurb");
    if ($awards->count() > 0) {
        $awards->each(function ($node) use(&$actor){
            $actor['awards'] .=  $node->innerText();
        });
    }

    return $actor;
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
    return view('frontend.title', ['movie' => $movie]);
})->name('title');

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

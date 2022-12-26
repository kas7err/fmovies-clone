<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showActor($id)
    {
        Cache::rememberForever($id, function () use ($id) {
            return Movie::with('genres')->whereJsonContains('cast', ['actor_id' => $id])->get();
        });
        $movies = Cache::pull($id);
        return view('frontend.actor', ['id' => $id,  'movies' => $movies]);
    }

    public function showTitle(Movie $movie)
    {
        return view('frontend.title', ['movie' => $movie]);
    }

    public function movies()
    {
        $gridData = ['title' => 'Movies', 'type' => 'Movie'];
        return view('frontend.movies', ['gridData' => $gridData]);
    }

    public function series() {
        $gridData = ['title' => 'TV Series', 'type' => 'TV'];
        return view('frontend.series', ['gridData' => $gridData]);
    }

    public function filter(Request $request)
    {
        $gridData = ['title' => 'Filter Movies', 'filter' => $request->query()];
        return view('frontend.filter', ['gridData' => $gridData]);
    }

    public function genre($title)
    {
        $gridData = ['title' => ucfirst($title) . ' Movies, TV Shows', 'genre' => $title];
        return view('frontend.genre', ['gridData' => $gridData]);
    }

    public function search(Request $request)
    {
        $gridData = ['title' => "Result form: $request->q", 'search' => true];
        return view('frontend.search', ['gridData' => $gridData]);
    }

    public function topImdb()
    {
        $gridData = ['title' => "Top IMDb", 'imdb' => true];
        return view('frontend.top-imdb', ['gridData' => $gridData]);
    }
}

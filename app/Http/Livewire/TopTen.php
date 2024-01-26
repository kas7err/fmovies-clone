<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use App\Models\Movie;
use Livewire\Component;

class TopTen extends Component
{
    public $selected = 'Action';

    public $movies;

    public function __construct()
    {
        $this->movies = Movie::with('genres')->whereHas('genres', function ($query) {
                    return $query->where('title', ucfirst($this->selected));
                })->take(10)->get();
    }

    public function topten(string $genre)
    {
        if ($genre == $this->selected) return;

        $this->selected = $genre;
        $this->movies = Movie::with('genres')->whereHas('genres', function ($query) {
                    return $query->where('title', ucfirst($this->selected));
                })->take(10)->get();
    }

    public function render()
    {
        return view('livewire.top-ten', [
            'genres' => Genre::all(),
            'movies' => $this->movies
        ]);
    }
}

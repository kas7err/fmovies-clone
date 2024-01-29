<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class TvGrid extends Component
{

    public $title;
    public $baseType = '';
    public $type = [];
    public $genre = '';
    public $filter = false;
    public $search = false;
    public $imdb = false;
    private $paginate = 24;

    public function render(Request $request)
    {
        return view('livewire.tv-grid', [
            'title' => $this->title,
            'data' => $this->filterData($request),
        ]);
    }

    public function filterData($request)
    {
        if ($this->genre !== '') {
            Cache::remember($this->genre, 60 * 60, function () {
                return Movie::with('genres')->whereHas('genres', function ($query) {
                    return $query->where('title', ucfirst($this->genre));
                })->paginate($this->paginate);
            });
            return Cache::pull($this->genre);
        }

        if ($this->imdb) {
            Cache::remember('imdb', 60 * 60, function () {
                return Movie::with('genres')->orderBy('rating', 'desc')->where('rating', '>', '8.5')->paginate($this->paginate);
            });
            return Cache::pull('imdb');
        }

        if ($this->filter) {
            return Movie::with('genres')->filter($request->query())->paginate($this->paginate);
        }

        if ($this->search) {
            return Movie::with('genres')->where('title', 'LIKE', "%{$request->q}%")->paginate($this->paginate);
        }

        Cache::remember($this->baseType, 60 * 60, function () {
            return Movie::with('genres')->whereIn('type', $this->type)->paginate($this->paginate);
        });
        return Cache::pull($this->baseType);
    }
}

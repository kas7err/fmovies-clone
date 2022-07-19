<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function submitSearch()
    {
        return redirect('/search?q=' . $this->search);
    }

    public function render()
    {
        $searchResult = Movie::with('genres')->where('title', 'LIKE', "%{$this->search}%")->limit(5)->get();
        return view('livewire.search', ['searchResult' => $searchResult]);
    }
}

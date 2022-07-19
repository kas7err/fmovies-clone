<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Navigation extends Component
{
    public function render()
    {
        return view('livewire.navigation', ['genres' => Genre::orderBy('title', 'asc')->get()]);
    }
}

<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class Filter extends Component
{

    public $years = [
        '2022', '2021', '2020', '2019', '2018', '2017', '2016', '2015', '2014', '2013', '2012', '2011', '2010',
        '2009', '2008', '2007', '2006', '2005', '2004', '2003', '2002',
        '2000s', '1990s', '1980s', '1970s', '1960s', '1950s', '1940s', '1930s', '1920s', '1910s', '1900s',
    ];

    public function render()
    {
        // dd(Genre::orderBy('title', 'asc')->get());
        return view('livewire.filter', ['genres' => Genre::orderBy('title', 'asc')->get()]);
    }
}

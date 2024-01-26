<?php

namespace App\Filament\Widgets;

use App\Models\Genre;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as StatsWidget;

class MoviesGenresOverview extends StatsWidget
{
    protected function getCards(): array
    {
        $genres = Genre::with('movies')->get();
        $cards = [];
        foreach ($genres as $g) {
            if (count($g->movies) > 50)
                array_push($cards, Card::make($g->title, count($g->movies)));
        }

        return $cards;
    }
}

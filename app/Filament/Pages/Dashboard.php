<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MoviesGenresOverview;
use App\Filament\Widgets\TopTenByGenre;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    /* protected static ?string $title = 'Test'; */

    protected function getWidgets(): array
    {
        return [
            TopTenByGenre::class,
            MoviesGenresOverview::class,
        ];
    }
}

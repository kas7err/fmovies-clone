<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TopTenByGenre extends Widget
{
    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.top-ten-by-genre';
}

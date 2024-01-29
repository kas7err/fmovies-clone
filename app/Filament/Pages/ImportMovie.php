<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;

class ImportMovie extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.import-movie';

    protected function getActions(): array
    {
        return [
            Action::make('New Movie')
            ->action(function (array $data): void {
                dd($data);
            })
            ->form([
                Forms\Components\TextInput::make('imdb_id')->label('IMDB ID')->required(),
            ])
        ];
    }
}

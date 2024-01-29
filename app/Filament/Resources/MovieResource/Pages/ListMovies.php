<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Filament\Widgets\MoviesGenresOverview;
use App\Models\Movie;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use hmerritt\Imdb;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('New Movie')
            ->action(function (array $data): void {
                $imdb = new Imdb;
                $response = $imdb->film($data['imdb_id']);


                $response = $this->change_key($data, "poster", "poster_url");
                unset($response['id']);
                unset($response['genres']);
                unset($response['technical_specs']);

                $movie = Movie::firstOrCreate($response);
            })
            ->form([
                TextInput::make('imdb_id')->label('IMDB ID')->required(),
            ])
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            MoviesGenresOverview::class,
        ];
    }

    function change_key($array, $old_key, $new_key)
    {
        if (!array_key_exists($old_key, $array))
        return $array;

        $keys = array_keys($array);
        $keys[array_search($old_key, $keys)] = $new_key;

        return array_combine($keys, $array);
    }
}

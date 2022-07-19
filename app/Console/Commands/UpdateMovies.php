<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use hmerritt\Imdb;
use \App\Models\Movie;
use \App\Models\Genre;

class UpdateMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all movies with IMDb crawler';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->moviesUpdate();
    }

    public function moviesUpdate()
    {
        $movies = Movie::all();
        foreach ($movies as $movie) {
            $imdb = new Imdb;
            $data = $imdb->film($movie->imdb_id, ['cache' => false]);
            $data = $this->change_key($data, "poster", "poster_url");

            $genres = $this->populateGenres($data['genres']);

            unset($data['id']);
            unset($data['genres']);
            unset($data['title']);
            unset($data['technical_specs']);
            unset($data['rating_votes']);

            $movie->update($data);
            $movie->genres()->sync($genres);
            $movie->save();
        }
    }

    public function populateGenres(array $genres)
    {
        $data  = [];
        foreach ($genres as $genre) {
            $data[] = Genre::firstOrCreate([
                'title' => $genre,
            ])->id;
        }
        return $data;
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

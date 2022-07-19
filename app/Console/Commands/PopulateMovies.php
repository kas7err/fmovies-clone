<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use hmerritt\Imdb;
use \App\Models\Movie;
use \App\Models\Genre;

class PopulateMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call IMDb api library and get all movies from Top 250 chart';

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
        $this->moviesCreate();
    }

    public function moviesCreate()
    {
        $charts = [
            'movies',
            'series',
            'popular-movies',
            'popular-series',
        ];
        $imdb = new Imdb;
        $data = [];
        foreach ($charts as $type) {
            $chart = $imdb->chart($type, ['cache' => false]);
            $data[] = $this->formatMovies($chart['shows']);
        }
        $data = Arr::collapse($data);
        $data = $this->unique_multidim_array($data, 'title');

        try {
            Movie::insert($data);
        } catch (\Throwable $th) {
            $this->info('unable to populate db');
        }
    }

    public function unique_multidim_array(array $data, String $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($data as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function formatMovies(array $movies)
    {
        $data = [];
        foreach ($movies as $movie) {
            $movie = $this->change_key($movie, "id", "imdb_id");
            $movie = $this->change_key($movie, "poster", "thumbnail_url");
            $data[] = $movie;
        }
        return $data;
    }

    public function change_key($array, $old_key, $new_key)
    {
        if (!array_key_exists($old_key, $array))
            return $array;

        $keys = array_keys($array);
        $keys[array_search($old_key, $keys)] = $new_key;

        return array_combine($keys, $array);
    }
}

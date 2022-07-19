<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DowloadPosterMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:posters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all movies and store posters to /images/imdb_id/movie_name';

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
        $this->moviesPoster();
    }

    public function moviesPoster()
    {
        $path = public_path() . '/images/titles';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        $movies = Movie::all();
        foreach ($movies as $movie) {
            // skip if image is stored localy
            $headers = @get_headers($movie->poster_url);
            if (!is_array($headers)) {
                continue;
            }

            $poster = \Image::make($movie->poster_url)->resize(200, 300)->encode('png', 60);
            $posterName = $movie->imdb_id . '_poster.png';
            $thumbnail = \Image::make($movie->thumbnail_url)->resize(60, 90)->encode('png', 60);
            $thumbnailName = $movie->imdb_id . '_thumbnail.png';
            Storage::disk('movies')->put($posterName, $poster);
            Storage::disk('movies')->put($thumbnailName, $thumbnail);

            $movie->poster_url = '/images/titles/' . $posterName;
            $movie->thumbnail_url = '/images/titles/' . $thumbnailName;
            $movie->save();
        }
    }
}

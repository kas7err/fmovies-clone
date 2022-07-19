<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // if (Cache::has('genres')) {
        //     View::share('genres', Cache::pull('genres'));
        // } else {
        //     $genres = Cache::rememberForever('genres', function () {
        //         return Genre::all();
        //     });
        //     View::share('genres', $genres);
        // }
    }
}

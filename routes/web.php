<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);

Route::get('/name/{id}', [FrontendController::class, 'showActor'])->name('showActor');

Route::get('/title/{movie:slug}', [FrontendController::class, "showTitle"])->name('title');

Route::get('/movies', [FrontendController::class, "movies"]);

Route::get('/series', [FrontendController::class, "series"]);

Route::get('/filter', [FrontendController::class, "filter"]);

Route::get('/genre/{title}', [FrontendController::class, "genre"]);

Route::get('/search', [FrontendController::class, "search"]);

Route::get('/top-imdb', [FrontendController::class, "topImdb"]);

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
    });

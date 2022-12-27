<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use hmerritt\Imdb;
use Illuminate\Support\Facades\Cache;

class ActorController extends Controller
{
    public function actor($id)
    {
        return Cache::rememberForever($id, function () use ($id) {
            $imdb = new Imdb;
            $actor = $imdb->actor($id);
            return response()->json($actor['actorInfo']);
        });
    }
}

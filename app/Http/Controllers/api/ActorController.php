<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Goutte\Client;
use hmerritt\Imdb;

class ActorController extends Controller
{
    public function actor($id)
    {
        $imdb = new Imdb;
        $actor = $imdb->actor($id, ['cache' => true]);
        return response()->json($actor['actorInfo']);
    }
}

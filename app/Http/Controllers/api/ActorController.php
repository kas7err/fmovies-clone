<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Goutte\Client;
use hmerritt\Imdb;

class ActorController extends Controller
{
    public function actorTest($id)
    {
        $imdb = new Imdb;
        $actor = $imdb->actor($id, ['cache' => true]);
        return response()->json($actor);
    }

    public  function actor($id) {
        $client = new Client();
        $crawler = $client->request('GET', "https://www.imdb.com/name/". $id ."/");

        $actor = [];
        $actor["name"] = "";
        $actor["bio"] = [];
        $actor["poster"] = "";
        $actor["photos"] = [];
        $actor["awards"] = "";

        $name = $crawler->filter('h1 span');
        if($name->count() > 0) {
            $actor['name'] = $name->text();
        }

        $poster = $crawler->filter("section.ipc-page-section--baseAlt img");
        /* dd($poster->count()); */
        if ($poster->count() > 0) {
            $actor["poster"] = $poster->attr("src");
        }

        $bio = $crawler->filter('div[data-testid="bio-content"]');
        if ($bio->count() > 0) {
            $actor["bio"]['text'] = $bio->text();
        }

        $photos = $crawler->filter(".mediastrip a > img");
        if ($photos->count() > 0) {
            $photos->each(function ($node) use(&$actor){
                $actor['photos'][] = $node->attr('loadlate');
            });
        }

        $awards = $crawler->filter("span.awards-blurb");
        if ($awards->count() > 0) {
            $awards->each(function ($node) use(&$actor){
                $actor['awards'] .=  $node->innerText();
            });
        }

        return $actor;
    }
}

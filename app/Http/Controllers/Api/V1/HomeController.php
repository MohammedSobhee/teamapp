<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Http\Resources\PitchResource;
use App\Http\Resources\PostResource;
use App\Match;
use App\Pitch;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home()
    {

        // list sponsors and pitches

        $sponsor_pitches = Pitch::where('status', 'active')->take(5)->orderByDesc('created_at')->get();
        // Object current match
        $current_match = Match::where('status', 'current')->first();
        // list articles
        $articles = Post::where('is_active', 1)->take(5)->orderByDesc('published_date')->get();
        $data = [
            'sponsor_pitches' => PitchResource::collection($sponsor_pitches),
            'current_match' => new MatchResource($current_match),
            'articles' => PostResource::collection($articles),
        ];
        return response_api(true, 200, null, $data);
    }
}

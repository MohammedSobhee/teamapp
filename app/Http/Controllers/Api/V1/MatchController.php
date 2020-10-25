<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Match\GetRequest;
use App\Repositories\Eloquents\MatchEloquent;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    //

    private $match;

    public function __construct(MatchEloquent $matchEloquent)
    {
        $this->match = $matchEloquent;
    }

    public function getMatches(GetRequest $request)
    {
        return $this->match->getAll($request->all());
    }
}

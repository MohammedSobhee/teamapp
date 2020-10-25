<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreateStatsRequest;
use App\Repositories\Eloquents\StatsEloquent;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    //

    private $stats;

    public function __construct(StatsEloquent $statsEloquent)
    {
        $this->stats = $statsEloquent;
    }

    public function addPlayerStats(CreateStatsRequest $request)
    {
        return $this->stats->addPlayerStats($request->all());
    }
}

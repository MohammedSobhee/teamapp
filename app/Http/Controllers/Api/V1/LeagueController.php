<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\League\CancelSubscriptionRequest;
use App\Http\Requests\Api\League\GetRequest;
use App\Repositories\Eloquents\LeagueEloquent;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    //
    private $league;

    public function __construct(LeagueEloquent $leagueEloquent)
    {
        $this->league = $leagueEloquent;
    }

    public function getLeagues(GetRequest $request)
    {
        return $this->league->getAll($request->all());
    }

    public function getLeague($id)
    {
        return $this->league->getById($id);
    }

    public function cancelSubscription(CancelSubscriptionRequest $request)
    {
        return $this->league->cancelSubscription($request->all());
    }

}

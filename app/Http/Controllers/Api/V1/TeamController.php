<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Team\CreateRequest;
use App\Http\Requests\Api\Team\GetRequest;
use App\Http\Requests\Api\Team\InvitePlayerRequest;
use App\Http\Requests\Api\Team\JoinLeagueRequest;
use App\Http\Requests\Api\Team\LeavePlayerRequest;
use App\Repositories\Eloquents\TeamEloquent;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    private $team;

    public function __construct(TeamEloquent $teamEloquent)
    {
        $this->team = $teamEloquent;
    }

    public function getTeams(GetRequest $request)
    {
        return $this->team->getAll($request->all());
    }

    public function getTeam($id)
    {
        return $this->team->getById($id);
    }

    public function createTeam(CreateRequest $request)
    {
        return $this->team->create($request->all());
    }

    // unused
    public function updateTeam(Request $request, $id)
    {
        return $this->team->update($request->all(), $id);
    }

    public function invitePlayer(InvitePlayerRequest $request)
    {
        return $this->team->invitePlayer($request->all());

    }

    public function leavePlayer(LeavePlayerRequest $request)
    {
        return $this->team->leavePlayer($request->all());

    }

    public function joinLeague(JoinLeagueRequest $request)
    {
        return $this->team->joinLeague($request->all());
    }
}

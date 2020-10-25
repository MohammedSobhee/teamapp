<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\TeamEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    private $team;

    public function __construct(TeamEloquent $teamEloquent)
    {
        $this->team = $teamEloquent;
    }

    public function anyData()
    {
        return $this->team->anyData();
    }


    public function changeStatus($team_id, $league_id)
    {
        return $this->team->changeStatus($team_id, $league_id);
    }

    public function index()
    {
        $data = [
            'sub_title' => 'Teams',
        ];

        session()->forget('league_id');
        return view(admin_teams_vw() . '.index', $data);

    }

    public function view($id)
    {
        $team = $this->team->getById($id);

//        dd(->merge($team->MatchTeamTwos()->where('match_date_time','<',Carbon::now())->get()));
        $matches_coming = $team->MatchTeamOnes()->where('match_date_time', '>=', Carbon::now())->get()->merge($team->MatchTeamTwos()->where('match_date_time', '>=', Carbon::now())->get());
        $matches_end = $team->MatchTeamOnes()->where('match_date_time', '<', Carbon::now())->get()->merge($team->MatchTeamTwos()->where('match_date_time', '<', Carbon::now())->get());


        $data = [
            'sub_title' => 'Team',
            'icon' => '',
            'team' => $team,
            'matches_coming' => $matches_coming,
            'matches_end' => $matches_end,
        ];

        return view(admin_teams_vw() . '.view', $data);

    }

}

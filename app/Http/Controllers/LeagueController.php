<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\Admin\League\CreateRequest;
use App\Http\Requests\Admin\League\UpdateRequest;
use App\League;
use App\LeagueGroup;
use App\LeagueTeamGroup;
use App\Match;
use App\Repositories\Eloquents\LeagueEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    //
    private $league;

    public function __construct(LeagueEloquent $leagueEloquent)
    {
        $this->league = $leagueEloquent;
    }

    public function anyData()
    {
        return $this->league->anyData();
    }

    public function teamNotLeagueData()
    {
        return $this->league->teamNotLeagueData();
    }

    public function index()
    {
        return view(admin_leagues_vw() . '.index');

    }

    public function add()
    {
        $data = [
            'cities' => City::all()
        ];
        return view(admin_leagues_vw() . '.add', $data);

    }

    public function changeStatus($id)
    {
        return $this->league->changeStatus($id);
    }

    public function createLeague(CreateRequest $request)
    {
        return $this->league->create($request->all());
    }

    public function updateLeague(UpdateRequest $request)
    {
        return $this->league->update($request->all());
    }

    public function postTeamLeague(Request $request)
    {
        return $this->league->postTeamLeague($request->all());
    }

    public function view($id)
    {
        session()->put('league_id', $id);

        $data = [
            'league' => League::find($id)
        ];
        return view(admin_leagues_vw() . '.view', $data);

    }

    public function edit($id)
    {


        $league = $this->league->getById($id);

        $league_teams_group = LeagueTeamGroup::where('league_id', $id)->pluck('team_id')->toArray();
        $league_teams = $league->Teams->whereNotIn('id', $league_teams_group);
        $league_groups = LeagueGroup::where('league_id', $id)->orderBy('name', 'ASC')->get();

        $matches = Match::where('league_id', $id)->orderBy('group_id')->get();
        $data = [
            'league' => $this->league->getById($id),
            'cities' => City::all(),
            'league_teams_group' => LeagueTeamGroup::where('league_id', $id)->get(),
            'league_teams' => $league_teams,
            'matches' => $matches,
            'league_groups' => $league_groups
        ];

        session()->put('league_id', $id);
        return view(admin_leagues_vw() . '.edit', $data);

    }

    public function addTeamLeague($league_id)
    {
        $league = $this->league->getById($league_id);
        $view = view()->make(modals('teams.league-team'), [
            'league' => $league
        ]);

        $html = $view->render();

        return $html;
    }

    public function removeTeamLeague($league_id, $team_id)
    {
        return $this->league->removeTeamLeague($league_id, $team_id);
    }
}

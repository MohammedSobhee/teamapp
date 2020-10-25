<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\League;
use App\LeagueGroup;
use App\LeagueTeamGroup;
use App\Match;
use App\Repositories\Interfaces\Repository;
use Carbon\Carbon;

class GroupEloquent implements Repository
{

    private $model;

    public function __construct(LeagueGroup $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function LeagueGroupData($league_id)
    {
        $league_team_groups = LeagueTeamGroup::where('league_id', $league_id)->orderByDesc('created_at');

        return datatables()->of($league_team_groups)
            ->filter(function ($query) {

            })
            ->editColumn('team_name', function ($league_team_group) {

                return $league_team_group->Team->name;
            })
            ->addIndexColumn()
            ->rawColumns(['logo', 'is_active', 'action'])->toJson();
    }

    function export()
    {


    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    function getById($id)
    {

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        // `name`, `league_id`

        //check if number of teams in group == 4

        if (count($attributes['teams_id']) != 4)
            return response_api(false, 422, 'يجب ان يكون عدد الفرق في المجموعة = 4', []);
        $league = League::find($attributes['league_id']);
        $default = 'A';
        $league_group = LeagueGroup::where('league_id', $attributes['league_id'])->orderByDesc('name')->first();
        if (isset($league_group))
            $default = ++$league_group->name;
        $group = new LeagueGroup();
        $group->name = $default;
        $group->league_id = $attributes['league_id'];
        if ($group->save()) {
            foreach ($attributes['teams_id'] as $team) {
                //`league_group_id`, `league_id`, `team_id`
                $league_team_group = new LeagueTeamGroup();
                $league_team_group->league_group_id = $group->id;
                $league_team_group->league_id = $attributes['league_id'];
                $league_team_group->team_id = $team;
                $league_team_group->save();
            }

            // check if groups are completed
            $league_teams_group = LeagueTeamGroup::where('league_id', $attributes['league_id'])->pluck('team_id')->toArray();
            $league_teams = $league->Teams->whereNotIn('id', $league_teams_group);

            if (count($league_teams) == 0) {
                // generate matches
                //SELECT `id`, `type`, `team_one_id`, `team_two_id`, `match_date_time`,
                // `city_id`, `league_id`, `pitch_id`, `group_id`, `status`, `team_one_result`,
                // `team_two_result`, `stage_name`, `description`,
                // `deleted_at`, `created_at`, `updated_at` FROM `matches` WHERE 1

                $this->generateMatches($league);

            }
            return response_api(true, 200, 'تم اضافة المجموعة بنجاح', empObj());

        }


        return response_api(false, 422, null, empObj());

    }

    public function generateMatches(League $league)
    {
        foreach ($league->Groups as $group) {
            $teams = $group->Teams->pluck('id')->toArray();
            for ($index = 0; $index < count($teams); $index++) {
                for ($i = $index + 1; $i < count($teams); $i++) {
                    $match = new Match();
                    $match->type = 'league';
                    $match->team_one_id = $teams[$index];
                    $match->team_two_id = $teams[$i];
                    $match->match_date_time = Carbon::now()->format('Y-m-d H:i:s');
                    $match->city_id = $league->city_id;
                    $match->league_id = $league->id;
                    $match->group_id = $group->id;
                    $match->level = 1;
                    $match->save();
                }
//                        $rowIndex = rand(0, count($teams) - 1);
//                        $team_one = ($teams[$rowIndex]);
//                        unset($teams[$rowIndex]);
//                        $teams = array_values($teams);
//                        $rowIndex = rand(0, count($teams) - 1);
//                        $team_two = ($teams[$rowIndex]);
//                        unset($teams[$rowIndex]);
//                        $teams = array_values($teams);


            }
        }

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.


    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $group = $this->model->find($id);


        if (isset($group) && $group->delete())
            return response_api(true, 200, __('app.deleted'), []);
        return response_api(false, 422, null, []);
    }
}

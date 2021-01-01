<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\League;
use App\LeagueTeam;
use App\LeagueTeamPlayer;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use App\Team;
use App\TeamPlayer;
use Carbon\Carbon;

class TeamEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Team $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $teams = $this->model->orderByDesc('created_at');


        return datatables()->of($teams)
            ->filter(function ($query) {
                //
                $search = request()->get('query')['teams_search'];
                if (isset($search)) {

                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
                }

                if (request()->filled('league_id')) {

                    $teams_id = LeagueTeam::where('league_id', request()->get('league_id'))->orderByDesc('created_at')->pluck('team_id')->toArray();

                    $ids_ordered = implode(',', $teams_id);

                    $query->whereIn('id', $teams_id)->orderByRaw("FIELD(id, $ids_ordered)");

                }
            })
            ->editColumn('logo', function ($team) {
                if (isset($team->logo100))
                    return '<a href="' . url(admin_teams_url() . '/view/' . $team->id) . '" target="_blank"><img src="' . $team->logo100 . '" class="rounded-circle"  width="80%"></a>';
                return '<a href="' . url(admin_teams_url() . '/view/' . $team->id) . '" target="_blank"><img src="' . url('assets/img/unknown.jpg') . '" class="rounded-circle" width="80%"></a>';
            })
//->editColumn('type', function ($league) {
//
//                return trans('app.types.' . $league->type);
//            })
            ->editColumn('name', function ($team) {
                return '<a href="' . url(admin_teams_url() . '/view/' . $team->id) . '" target="_blank">' . $team->name . '</a>';
            })
            ->addColumn('status_action', function ($team) {

                if (request()->filled('league_id')) {
                    $team_league = $team->Leagues()->where('league_id', request()->get('league_id'))->first();


                    $checked = ($team_league->pivot->status == 'approved') ? 'checked="checked"' : '';

                    return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status_action" data-status="' . $team_league->pivot->status . '" data-link="' . url(admin_teams_url() . '/change-league-status/' . $team->id . '/' . request()->get('league_id')) . '" name="">
															<span></span>
														</label>
													</span>';
                }
            })->
            addColumn('action', function ($team) {
                $url = '#';
                $action = '';
//                if (request()->filled('league_id')) {
////                    $url = url(admin_leagues_url() . '/remove-team/' . request()->get('league_id') . '/' . $team->id);
//
//                    $action = '<span class="m-switch m-switch--icon m-switch--primary">
//														<label>
//															<input type="checkbox" checked="checked" name="">
//															<span></span>
//														</label>
//													</span>';
//                }
                return $action . '<a href="' . url(admin_teams_url() . '/view/' . $team->id) . '"
                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                           title="تعديل"><i class="la la-eye"></i></a>

                            ';
//                <a href="' . $url . '"
//                           class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete"
//                           title="حذف"><i class="la la-trash"></i></a>
            })->addIndexColumn()
            ->rawColumns(['name', 'logo', 'is_active', 'status_action', 'action'])->toJson();
    }

    function changeStatus($team_id, $league_id)
    {
        $team_league = LeagueTeam::where('team_id', $team_id)->where('league_id', $league_id)->first();
        if (!isset($team_league))
            return response_api(false, 422, null, []);
        if ($team_league->status == 'approved')
            $team_league->status = 'disable';
        else
            $team_league->status = 'approved';
        $team_league->save();
        return response_api(true, 200, null, $team_league);

    }

    function export()
    {


    }

    function getAll(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $collection = $this->model;

        if (isset($attributes['name'])) {
            $collection = $collection->where('name', 'LIKE', '%' . $attributes['name'] . '%');
        }
        if (isset($attributes['league_id'])) {
            $league_teams = LeagueTeam::where('league_id', $attributes['league_id'])->pluck('team_id')->toArray();
            // teams not participating in that league
            $collection = $collection->whereNotIn('id', $league_teams);
        }

        if (isset($attributes['type'])) {
            if ($attributes['type'] == 'all_my_team') {

                $team_ids = TeamPlayer::where('player_id', auth()->user()->id)->where('status', 'exist')->pluck('team_id');
                $collection = $collection->where(function ($query) use ($team_ids) {
                    $query->where('coach_id', auth()->user()->id)->orWhereIn('id', $team_ids);
                });
            }
            if ($attributes['type'] == 'my_team') {

                $collection = $collection->where(function ($query) {
                    $query->where('coach_id', auth()->user()->id);
                });
            }
            if ($attributes['type'] == 'other_teams') {
                $collection = $collection->where('coach_id', '<>', auth()->user()->id);
            }
        }

        $count = $collection->count();

        if (isset($attributes['is_all']) && $attributes['is_all']) {
            return response_api(true, 200, null, $collection->get(), 1, 0, $count);
        }
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;

        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            return response_api(true, 200, null, $object, $page_count, $page_number, $count);
        }
    }


    function getById($id)
    {
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $team = $this->model->find($id);
            if (isset($team))
                return response_api(true, 200, null, $team);
            return response_api(false, 422, trans('app.not_data_found'), empObj());
        }
        return $this->model->find($id);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $team = new Team();
        $team->name = $attributes['name'];
        $team->type = $attributes['type'];
        $team->city_id = $attributes['city_id'];
        $team->coach_id = auth()->user()->id;
        if (isset($attributes['description']))
            $team->description = $attributes['description'];

        if ($team->save()) {
            if (isset($attributes['logo'])) {
                $team->logo = $this->storeImageThumb('teams', $team->id, $attributes['logo']);
                $team->save();

            }
            if (isset($attributes['bg_image'])) {
                sleep(1);
                $team->bg_image = $this->storeImageThumb('teams', $team->id, $attributes['bg_image']);
                $team->save();
            }
            $team = $this->model->find($team->id);

            foreach ($attributes['players_'] as $player) {
                $team_player = TeamPlayer::where('team_id', $team->id)->where('status', 'exist')->where('player_id', $player->player_id)->first();
                if (!isset($team_player))
                    $team_player = new TeamPlayer();
                $team_player->team_id = $team->id;
                $team_player->player_id = $player->player_id;
                if (isset($player->position_id))
                    $team_player->position_id = $player->position_id;
                $team_player->save();
            }


            return response_api(true, 200, trans('app.created'), $team);
        }
        return response_api(false, 422, null, empObj());

    }

    public function leavePlayer(array $attributes)
    {

        $team_player = TeamPlayer::where('team_id', $attributes['team_id'])->where('status', 'exist')->where('player_id', auth()->user()->id)->first();

        if (isset($team_player)) {
            $team_player->status = 'leave';
            $team_player->save();
            return response_api(true, 200, trans('app.leaved'), empObj());
        }
        return response_api(false, 422, null, empObj());

    }

    public function invitePlayer(array $attributes)
    {

        foreach ($attributes['players'] as $player) {
            $team_player = TeamPlayer::where('team_id', $attributes['team_id'])->where('status', 'exist')->where('player_id', $player['player_id'])->first();
            if (!isset($team_player))
                $team_player = new TeamPlayer();

            $team = $this->model->find($attributes['team_id']);
            $team_player->team_id = $attributes['team_id'];
            $team_player->player_id = $player['player_id'];
//            $team_player->position_id = $player['position_id'];
            $team_player->is_captain = $player['is_captain'];
            $team_player->is_coach = $team->coach_id;
            if ($team_player->save()) {
                if (isset($player['is_captain']) && $player['is_captain']) {
                    $team->captain_id = $player['player_id'];
                    $team->save();
                }
            }
        }

        return response_api(true, 200, trans('app.invited'), empObj());

    }

    public function joinLeague(array $attributes)
    {
        $league = League::whereRaw('(main_player_no + reserved_player_no) = ' . count($attributes['players_']))->find($attributes['league_id']);
        if (!isset($league))
            return response_api(false, 422, 'العدد المسجل لا يتوافق مع عدد الاعبين داخل البطولة', empObj());

        if ($league->status != 'new')
            return response_api(false, 422, 'انتهى التسجيل في هذه البطولة', empObj());

        $league_team = LeagueTeam::where('team_id', $attributes['team_id'])->where('league_id', $attributes['league_id'])->first();
        if (isset($league_team)) {
            return response_api(false, 422, 'الفريق مسجل مسبقاً في هذه البطولة', empObj());
        }
        $league_team = new LeagueTeam();
        $league_team->team_id = $attributes['team_id'];
        $league_team->league_id = $attributes['league_id'];
        $league_team->register_players_no = count($attributes['players_']);
        if ($league_team->save()) {
            foreach ($attributes['players_'] as $player) {
                $league_team_player = new LeagueTeamPlayer();
//                `league_id`, `team_id`, `player_id`, `position_id`, `player_no`
                $league_team_player->league_id = $attributes['league_id'];
                $league_team_player->team_id = $attributes['team_id'];
                $league_team_player->player_id = $player->player_id;
                $league_team_player->player_no = $player->player_no;
                $league_team_player->position_id = $player->position_id;
                $league_team_player->save();
            }
        }


        return response_api(true, 200, trans('app.invited'), empObj());

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $team = $this->model->find($id);
        $team->name = $attributes['name'];

        if (isset($attributes['logo'])) {
            $team->logo = $this->storeImageThumb('teams', $team->id, $attributes['logo']);
            $team->save();

        }
        if (isset($attributes['bg_image'])) {
            sleep(1);
            $team->bg_image = $this->storeImageThumb('teams', $team->id, $attributes['bg_image']);
            $team->save();
        }
        return response_api(true, 200, trans('app.created'), $team);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.

    }
}

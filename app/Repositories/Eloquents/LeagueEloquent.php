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
use Carbon\Carbon;

class LeagueEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(League $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $leagues = $this->model->orderByDesc('created_at');

        return datatables()->of($leagues)
            ->filter(function ($query) {
                //
                if (request()->filled('status')) {
//                    if (request()->get('status') == 'new') {
//                        $query->whereDate('date_from', '>', Carbon::now()->format('Y-m-d'));
//                    }
//                    if (request()->get('status') == 'current') {
//                        $query->whereDate('date_from', '<=', Carbon::now()->format('Y-m-d'))->whereDate('date_to', '>=', Carbon::now()->format('Y-m-d'));
//                    }
//                    if (request()->get('status') == 'finished') {
//                        $query->whereDate('date_to', '<', Carbon::now()->format('Y-m-d'));
//                    }
                    $query->where('status', request()->get('status'));
                }
            })
            ->addColumn('logo', function ($league) {

                if (isset($league->logo100))
                    return '<img src="' . $league->logo100 . '" class="rounded-circle" style="width: 60px;height: 60px;">';
                return '<img src="' . url('assets/img/league.jpg') . '" class="rounded-circle" style="width: 60px;height: 60px;">';
            })->editColumn('type', function ($league) {

                return trans('app.types.' . $league->type);
            })
            ->addColumn('action', function ($league) {
                $action = '';

                if ($league->status == 'new') {
                    $action = '<a href="' . url(admin_leagues_url() . '/change-status/' . $league->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill status" title="بداية"><i class="la la-check"></i></a>';
                } else if ($league->status == 'current') {
                    $action = '<a href="' . url(admin_leagues_url() . '/change-status/' . $league->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill status" title="نهاية"><i class="la la-times"></i></a>';
                }
                return $action . '<a href="' . url(admin_leagues_url() . '/edit/' . $league->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="بداية"><i class="la la-edit"></i></a>
                                <a href="' . url(admin_leagues_url() . '/view/' . $league->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="مشاهدة"><i class="la la-eye"></i></a>
                            ';
            })->addIndexColumn()
            ->rawColumns(['logo', 'is_active', 'action'])->toJson();
    }

    function teamNotLeagueData()
    {
        $teams_id = LeagueTeam::where('league_id', request()->get('league_id'))->pluck('team_id')->toArray();
        $teams = Team::whereNotIn('id', $teams_id)->orderByDesc('created_at');

        return datatables()->of($teams)
            ->filter(function ($query) {
                //v
            })
            ->editColumn('name', function ($team) {
                return '<a href="' . url(admin_teams_url() . '/view/' . $team->id) . '" target="_blank">' . $team->name . '</a>';
            })
            ->addColumn('number', function ($team) {
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
            ->addIndexColumn()
            ->rawColumns(['name', 'logo', 'is_active', 'action'])->toJson();
    }

    public function postTeamLeague(array $attributes)
    {
        $league = $this->getById($attributes['league_id']);

        if (isset($attributes['teams_id']))
            $teams = explode(',', str_replace('on,', '', $attributes['teams_id'][0]));

        if (!isset($league) || /*$league->status != 'new' ||*/ !isset($teams) || count($teams) == 0)
            return response_api(false, 422, 'انتهى التسجيل في هذه البطولة', empObj());

        $league_teams_num = LeagueTeam::where('league_id', $attributes['league_id'])->where('status', 'approved')->pluck('team_id')->unique()->count();

        if ($league->teams_no < ($league_teams_num + count($teams))) {
            $league_teams_num = abs(count($teams) - $league_teams_num);
            return response_api(false, 422, "($league_teams_num) العدد الفرق المسموح اضافتها ", empObj());
        }

        $number = 0;
        foreach ($teams as $team_id) {

            $team = Team::find($team_id);
            $league_team = LeagueTeam::where('team_id', $team_id)->where('league_id', $attributes['league_id'])->first();
            if (isset($league_team) || !isset($team)) continue;

            $players_num_league = $league->main_player_no + $league->reserved_player_no;
            $players = $team->Players()->where('is_complete_profile', 1)->take($players_num_league)->get();

            if (count($players) != $players_num_league) continue;

            $number++;
            $league_team = new LeagueTeam();
            $league_team->team_id = $team_id;
            $league_team->status = 'approved';
            $league_team->league_id = $attributes['league_id'];
            $league_team->register_players_no = $players_num_league;
            if ($league_team->save()) {
                $index = 0;
                foreach ($players as $player) {

                    $league_team_player = LeagueTeamPlayer::where('league_id', $attributes['league_id'])->where('team_id', $team_id)->where('player_id', $player->id)->first();
                    if (isset($league_team_player)) continue;
                    $league_team_player = new LeagueTeamPlayer();
//                `league_id`, `team_id`, `player_id`, `position_id`, `player_no`
                    $league_team_player->league_id = $attributes['league_id'];
                    $league_team_player->team_id = $team_id;
                    $league_team_player->player_id = $player->id;
                    $league_team_player->player_no = ++$index;
                    $league_team_player->position_id = $player->primer_position_id;
                    $league_team_player->save();
                }

            }

        }
        if ($number > 0)
            return response_api(true, 200, trans('app.invited'), empObj());
        return response_api(false, 422, 'عدد اللاعبين فالفرق اقل  من الشرط المطلوب', empObj());

    }

    function export()
    {


    }

    function getAll(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $collection = $this->model;
//
//        if (isset($attributes['name'])) { current,end
//            $collection = $collection->where('name', 'LIKE', '%' . $attributes['name'] . '%');
//        }


        if (isset($attributes['type'])) {
            if ($attributes['type'] == 'current') {
//
                $collection = $collection->whereDate('date_from', '>', Carbon::now()->format('Y-m-d'))->orWhere(function ($query) {
                    $query->whereDate('date_from', '<=', Carbon::now()->format('Y-m-d'))->whereDate('date_to', '>=', Carbon::now()->format('Y-m-d'));
                });
            }
            if ($attributes['type'] == 'finished') {
                $collection = $collection->whereDate('date_to', '<', Carbon::now()->format('Y-m-d'));//whereDate('date_to', '<=', Carbon::now()->format('Y-m-d H:i:s'));

            }
        }

        $count = $collection->count();
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
            $league = $this->model->find($id);
            if (isset($league))
                return response_api(true, 200, null, $league);
            return response_api(false, 422, trans('app.not_data_found'), empObj());
        }
        return $this->model->find($id);

    }

    function cancelSubscription(array $attributes)
    {
        $league_team = LeagueTeam::where('team_id', $attributes['team_id'])->where('league_id', $attributes['league_id'])->first();
        if (isset($league_team) && $league_team->delete()) {
            return response_api(true, 200, 'تم الغاء الاشتراك بنجاح', empObj());
        }
        return response_api(false, 422, null, empObj());

    }

    function changeStatus($id)
    {
        $league = $this->model->find($id);
        if ($league->status == 'new')
            $league->status = 'current';
        else
            $league->status = 'finished';
        $league->save();
        return response_api(true, 200, null, $league);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        if ($attributes['teams_no'] % 4 != 0) {
            return response_api(false, 422, 'يجب ان يكون عدد الفرق من مضاعفات العدد ٤', empObj());
        }
        $league = new League();
        $league->name = $attributes['name'];
        $league->date_from = $attributes['date_from'];
        $league->date_to = $attributes['date_to'];
        $league->registration_deadline = $attributes['registration_deadline'];
        $league->city_id = $attributes['city_id'];
        $league->teams_no = $attributes['teams_no'];
        $league->main_player_no = $attributes['main_player_no'];
        $league->reserved_player_no = $attributes['reserved_player_no'];
        $league->type = $attributes['type'];
        $league->payment_type = $attributes['payment_type'];
        if ($attributes['payment_type'] == 'paid')
            $league->payment_cost = $attributes['payment_cost'];
        if (isset($attributes['condition_text']))
            $league->condition_text = $attributes['condition_text'];

        if ($league->save()) {
            if (isset($attributes['logo'])) {
                $league->logo = $this->storeImageThumb('leagues', $league->id, $attributes['logo']);
                $league->save();
            }
            $league = $this->model->find($league->id);
            return response_api(true, 200, trans('app.created'), ['url' => url(admin_leagues_url() . '/edit/' . $league->id)]);
        }
        return response_api(false, 422, null, empObj());

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.

        if ($attributes['type'] == 'tournament') {
            // يجب ان يكون عدد الفرق يقبل القسمة على اربعة
            // يتم انشاء المباريات في الدور المجموعات بشكل عشوائي وبعد ذالك يتم تحديد المباريات من لوحة التحكم

            if ($attributes['teams_no'] % 4 != 0) {
                return response_api(false, 422, 'عدد الفرق في البطولة يقبل القسمة على ٤', empObj());
            }
        } else {

            // يجب ان يكون عدد الفرق يقبل القسمة 2^n n تمثل عدد الدوار
            // يتم انشاء المباريات بشكل عشوائي

            if (!isPowerOfTwo($attributes['teams_no'])) {
                return response_api(false, 422, 'عدد الفرق في البطولة 2^n', empObj());
            }
        }
        $league = $this->model->find($attributes['league_id']);
        $league->name = $attributes['name'];
        $league->date_from = $attributes['date_from'];
        $league->date_to = $attributes['date_to'];
        $league->registration_deadline = $attributes['registration_deadline'];
        $league->city_id = $attributes['city_id'];
        $league->teams_no = $attributes['teams_no'];
        $league->main_player_no = $attributes['main_player_no'];
        $league->reserved_player_no = $attributes['reserved_player_no'];
        $league->type = $attributes['type'];
        $league->payment_type = $attributes['payment_type'];
        if ($attributes['payment_type'] == 'paid')
            $league->payment_cost = $attributes['payment_cost'];
        if (isset($attributes['condition_text']))
            $league->condition_text = $attributes['condition_text'];

        if ($league->save()) {
            if (isset($attributes['logo'])) {
                $league->logo = $this->storeImageThumb('leagues', $league->id, $attributes['logo']);
                $league->save();
            }
            $league = $this->model->find($league->id);
            return response_api(true, 200, trans('app.updated'), $league);
        }
        return response_api(false, 422, null, empObj());

    }

    function removeTeamLeague($league_id, $team_id)
    {
        // TODO: Implement delete() method.
        $leagueTeam = LeagueTeam::where('league_id', $league_id)->where('team_id', $team_id)->first();
        if (isset($leagueTeam) && $leagueTeam->delete())
            return response_api(true, 200, trans('app.deleted'), empObj());
        return response_api(false, 422, null, empObj());

    }

    function delete($id)
    {
        // TODO: Implement delete() method.

    }
}

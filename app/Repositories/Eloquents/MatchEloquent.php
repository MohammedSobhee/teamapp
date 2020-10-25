<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Http\Resources\MatchResource;
use App\Match;
use App\MatchTimeline;
use App\Repositories\Interfaces\Repository;
use Carbon\Carbon;

class MatchEloquent implements Repository
{

    private $model;

    public function __construct(Match $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $matches = $this->model->with(['TeamOne', 'TeamTwo', 'Pitch'])->orderByDesc('created_at');

        return datatables()->of($matches)
            ->filter(function ($query) {
                //
                if (request()->filled('status')) {
//                    $query->where('status', request()->get('status'));
                    if (request()->get('status') == 'new')
                        $query->where('match_date_time', '>', Carbon::now());
                    else
                        $query->where('status', request()->get('status'));


                }

            })
            ->editColumn('type', function ($match) {

                return trans('app.types.' . $match->type);
            })->editColumn('level', function ($match) {

                return trans('app.group.' . $match->level);
            })->addColumn('team_one_name', function ($match) {

                return $match->TeamOne->name;
            })->addColumn('team_two_name', function ($match) {

                return $match->TeamTwo->name;
            })->addColumn('pitch_name', function ($match) {

                if (isset($match->Pitch))
                    return $match->Pitch->name;
                return '-';
            })
            ->addColumn('action', function ($match) {

                $action = '';

                if ($match->status == 'new') {
                    $action = '<a href="' . url(admin_matches_url() . '/change-status/' . $match->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill status" title="بداية"><i class="la la-check"></i></a>';
                } else if ($match->status == 'current') {
                    $action = '<a href="' . url(admin_matches_url() . '/change-status/' . $match->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill status" title="نهاية"><i class="la la-times"></i></a>';
                }

                $edit = '';
                if ($match->status != 'finished')
                    $edit = '<a href="' . url(admin_matches_url() . '/edit/' . $match->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="بداية"><i class="la la-edit"></i></a>';
                return $action . $edit . '<a href="' . url(admin_matches_url() . '/view/' . $match->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="مشاهدة"><i class="la la-eye"></i></a>';
            })->addIndexColumn()
            ->rawColumns(['action'])->toJson();
    }


    function export()
    {


    }

    function getAll(array $attributes)
    {

        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $collection = $this->model;

        if (isset($attributes['league_id'])) {
            $collection = $collection->where('league_id', $attributes['league_id']);
        }

        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;

        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            return response_api(true, 200, null, MatchResource::collection($object), $page_count, $page_number, $count);
        }
    }

    function getById($id)
    {
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $match = $this->model->find($id);
            if (isset($match))
                return response_api(true, 200, null, $match);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function changeStatus($id)
    {
        $match = $this->model->find($id);
        if ($match->status == 'new')
            $match->status = 'current';
        else
            $match->status = 'finished';
        $match->save();
        return response_api(true, 200, null, $match);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

//        `type`, `team_one_id`, `team_two_id`, `match_date_time`, `city_id`, `league_id`, `pitch_id`,
// `group_id`, `status`, `team_one_result`, `team_two_result`, `level`, `description`

        $match = new Match();
        $match->type = $attributes['type'];
        $match->team_one_id = $attributes['team_one_id'];
        $match->team_two_id = $attributes['team_two_id'];
        $match->match_date_time = $attributes['match_date_time'];
        $match->city_id = $attributes['city_id'];
        if (isset($attributes['league_id']))
            $match->league_id = $attributes['league_id'];
        if (isset($attributes['pitch_id']))
            $match->pitch_id = $attributes['pitch_id'];
        if (isset($attributes['group_id']))
            $match->group_id = $attributes['group_id'];
//        $match->team_one_result = $attributes['team_one_result'];
//        $match->team_two_result = $attributes['team_two_result'];
        if (isset($attributes['level']))
            $match->level = $attributes['level'];
        if (isset($attributes['description']))
            $match->description = $attributes['description'];
        if ($match->save())
            return response_api(true, 200, trans('app.created'), empObj());
        return response_api(false, 422, null, empObj());

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $match = $this->model->find($id);
        if (isset($attributes['type']))
            $match->type = $attributes['type'];
        $match->team_one_id = $attributes['team_one_id'];
        $match->team_two_id = $attributes['team_two_id'];
        $match->match_date_time = $attributes['match_date_time'];
        $match->city_id = $attributes['city_id'];
        if (isset($attributes['league_id']))
            $match->league_id = $attributes['league_id'];
        if (isset($attributes['pitch_id']))
            $match->pitch_id = $attributes['pitch_id'];
        if (isset($attributes['group_id']))
            $match->group_id = $attributes['group_id'];
        if (isset($attributes['team_one_result']))
            $match->team_one_result = $attributes['team_one_result'];
        if (isset($attributes['team_two_result']))
            $match->team_two_result = $attributes['team_two_result'];
        if (isset($attributes['level']))
            $match->level = $attributes['level'];
        if (isset($attributes['description']))
            $match->description = $attributes['description'];
        if ($match->save())
            return response_api(true, 200, trans('app.updated'), $match);
        return response_api(false, 422, null, empObj());

    }

    function record(array $attribute)
    {
        $record = MatchTimeline::where('track_type', $attribute['track_type'])
            ->where('player_id', $attribute['player_id'])
            ->where('team_id', $attribute['team_id'])
            ->where('match_id', $attribute['match_id'])
            ->where('track_time', $attribute['track_time'])->first();
        if (!isset($record))
            $record = new MatchTimeline();
        $record->track_type = $attribute['track_type'];
        $record->player_id = $attribute['player_id'];
        $record->team_id = $attribute['team_id'];
        $record->match_id = $attribute['match_id'];
        $record->track_time = $attribute['track_time'];
        if (isset($attribute['substituted_player_id']))
            $record->substituted_player_id = $attribute['substituted_player_id'];
        if ($record->save())
            return response_api(true, 200, __('app.success'), $record);
        return response_api(false, 422, null, empObj());
    }

    function deleteRecord($id)
    {
        // TODO: Implement delete() method.
        $record = MatchTimeline::find($id);
        if (isset($record) && $record->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $match = $this->model->find($id);
        if (isset($match) && $match->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }
}

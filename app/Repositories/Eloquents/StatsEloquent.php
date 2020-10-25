<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\PlayerRate;
use App\PlayerStats;
use App\Repositories\Interfaces\Repository;
use App\Stats;

class StatsEloquent implements Repository
{

    private $model;

    public function __construct(Stats $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $stats = $this->model->orderByDesc('created_at');
        return datatables()->of($stats)
            ->filter(function ($query) {
                $search = request()->get('query')['stats_table_search'];

                if (isset($search)) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                }


            })->editColumn('is_active', function ($stat) {
                $checked = ($stat->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $stat->is_active . '" data-link="' . url(admin_settings_url() . '/stats/' . $stat->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($stat) {
                return '<a href="' . url(admin_settings_url() . '/stats/' . $stat->id . '/edit') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit-stats-mdl" title="تعديل"><i class="la la-edit"></i></a>
                        <a href="' . url(admin_settings_url() . '/stats/' . $stat->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete" title="حذف"><i class="la la-trash"></i></a>
                    ';
            })->addIndexColumn()
            ->rawColumns(['is_active', 'action'])->toJson();
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
        if (request()->segment(1) == 'api') {
            // TODO: Implement getById() method.
            $stats = $this->model->find($id);
            if (isset($stats))
                return response_api(true, 200, null, $stats);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $stats = new Stats();
        $stats->name = $attributes['name'];
        if ($stats->save())
            return response_api(true, 200, trans('app.created'), $stats);
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $stats = $this->getById($id);
        $stats->name = $attributes['name'];
        if ($stats->save())
            return response_api(true, 200, trans('app.updated'), $stats);
        return response_api(false, 422, null, []);


    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $stats = $this->model->find($id);
        if (isset($stats) && $stats->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $stats = $this->model->find($id);

        if (isset($stats)) {
            $stats->is_active = !$stats->is_active;
            $stats->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }

    function addPlayerStats(array $attributes)
    {
        // TODO: Implement delete() method.
        $stats = new PlayerStats();
        $stats->stats_id = $attributes['stats_id'];
        $stats->player_id = $attributes['player_id'];
        $stats->value = $attributes['value'];
        $stats->save();
        return response_api(true, 200, null, []);

    }


}

<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\City;
use App\Position;
use App\Repositories\Interfaces\Repository;

//use Excel;

class PositionEloquent implements Repository
{

    private $model;

    public function __construct(Position $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $positions = $this->model->orderByDesc('created_at');
        return datatables()->of($positions)
            ->filter(function ($query) {
                $search = request()->get('query')['position_table_search'];

                if (isset($search)) {
                    $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('title', 'LIKE', '%' . $search . '%');
                }


            })->editColumn('is_active', function ($position) {
                $checked = ($position->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $position->is_active . '" data-link="' . url(admin_settings_url() . '/positions/' . $position->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($stat) {
                return '<a href="' . url(admin_settings_url() . '/positions/' . $stat->id . '/edit') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit-positions-mdl" title="تعديل"><i class="la la-edit"></i></a>
                        <a href="' . url(admin_settings_url() . '/positions/' . $stat->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete" title="حذف"><i class="la la-trash"></i></a>
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
            $position = $this->model->find($id);
            if (isset($position))
                return response_api(true, 200, null, $position);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $position = new Position();
        $position->name = $attributes['name'];
        $position->title = $attributes['title'];
        if ($position->save())
            return response_api(true, 200, trans('app.created'), $position);
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $position = $this->getById($id);
        $position->name = $attributes['name'];
        $position->title = $attributes['title'];
        if ($position->save())
            return response_api(true, 200, trans('app.updated'), $position);
        return response_api(false, 422, null, []);


    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $position = $this->model->find($id);
        if (isset($position) && $position->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $position = $this->model->find($id);

        if (isset($position)) {
            $position->is_active = !$position->is_active;
            $position->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }
}

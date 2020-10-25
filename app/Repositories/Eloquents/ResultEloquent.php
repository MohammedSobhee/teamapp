<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\Repository;
use App\ResultType;
use App\Stats;

class ResultEloquent implements Repository
{

    private $model;

    public function __construct(ResultType $model)
    {
        $this->model = $model;

    }

    // for cpanel
    function anyData()
    {
        $result_types = $this->model->orderByDesc('created_at');
        return datatables()->of($result_types)
            ->filter(function ($query) {
                $search = request()->get('query')['result_types_table_search'];

                if (isset($search)) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                }


            })->editColumn('is_active', function ($result_type) {
                $checked = ($result_type->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $result_type->is_active . '" data-link="' . url(admin_settings_url() . '/results/' . $result_type->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($result_type) {
                return '<a href="' . url(admin_settings_url() . '/results/' . $result_type->id . '/edit') . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit-results-mdl" title="تعديل"><i class="la la-edit"></i></a>
                        <a href="' . url(admin_settings_url() . '/results/' . $result_type->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete" title="حذف"><i class="la la-trash"></i></a>
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
            $result_types = $this->model->find($id);
            if (isset($result_types))
                return response_api(true, 200, null, $result_types);
            return response_api(false, 422, trans('app.not_data_found'), []);
        }
        return $this->model->find($id);

    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.

        $result_types = new ResultType();
        $result_types->name = $attributes['name'];
        if ($result_types->save())
            return response_api(true, 200, trans('app.created'), $result_types);
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.
        $result_types = $this->getById($id);
        $result_types->name = $attributes['name'];
        if ($result_types->save())
            return response_api(true, 200, trans('app.updated'), $result_types);
        return response_api(false, 422, null, []);


    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $result_types = $this->model->find($id);
        if (isset($result_types) && $result_types->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $result_types = $this->model->find($id);

        if (isset($result_types)) {
            $result_types->is_active = !$result_types->is_active;
            $result_types->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }
}

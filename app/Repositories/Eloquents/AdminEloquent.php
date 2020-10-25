<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Admin;
use App\AdminRole;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;
use Excel;
use Mail;
use Password;

class AdminEloquent extends Uploader implements Repository
{

    private $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    function anyData()
    {

        $admins = $this->model->where('type', 'admin')->orderByDesc('created_at');

        return datatables()->of($admins)
            ->filter(function ($query) {
//
//                $search = request()->get('query')['members_search'];
//
//                if (isset($search)) {
//                    $cities_id = City::where('name_en', 'LIKE', '%' . $search . '%')->pluck('id');
//
//                    $query->where(function ($query) use ($search, $cities_id) {
//                        $query->where('first_name', 'LIKE', '%' . $search . '%')->orWhere('last_name', 'LIKE', '%' . $search . '%')->orWhereIn('city_id', $cities_id);
//                    });
//                }
            })
            ->editColumn('logo', function ($admin) {
                if (isset($admin->logo100))
                    return '<img src="' . $admin->logo100 . '" class="rounded-circle"  width="80%">';
                return '<img src="' . url('assets/img/placeholder-user.png') . '" class="rounded-circle" width="80%">';
            })
            ->addColumn('is_active', function ($admin) {
                $checked = ($admin->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $admin->is_active . '" data-link="' . url(admin_users_url() . '/admin/' . $admin->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($admin) {

                return '<a href="' . url(admin_users_url() . '/profile/' . $admin->id) . '"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                   title="تعديل"><i class="la la-edit"></i></a>
                                <a href="' . url(admin_users_url() . '/delete-admin/' . $admin->id) . '"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete"
                                   title="حذف"><i class="la la-trash"></i></a>';
            })->addIndexColumn()
            ->rawColumns(['logo', 'is_active', 'action'])->toJson();
    }

    function export()
    {

        Excel::create('Admins data', function ($excel) {

            $excel->sheet('Sheet 1', function ($sheet) {

                $collection = $this->model;
                if (request()->filled('name')) {
                    $collection = $collection->where('username', 'LIKE', '%' . request()->get('name') . '%');
                }
                if (request()->filled('email')) {
                    $collection = $collection->where('email', 'LIKE', '%' . request()->get('email') . '%');
                }
                if (request()->filled('level')) {
                    $collection = $collection->where('level', request()->get('level'));
                }
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('Full name');
                });
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue('Email');
                });
                $sheet->cell('C1', function ($cell) {
                    $cell->setValue('Level');
                });
                $data = $collection->get();

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value['username']);
                        $sheet->cell('B' . $i, $value['email']);
                        $sheet->cell('C' . $i, $value['level']);
                    }
                }

            });
        })->export('xls');
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    function getById($id)
    {
        // TODO: Implement getById() method.
        return $this->model->find($id);
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $admin = new Admin();
//        $admin->name = $attributes['name'];
        $admin->username = $attributes['username'];
        $admin->mobile = $attributes['mobile'];
        $admin->email = $attributes['email'];
        $admin->password = bcrypt(generateVerificationCode());

        if ($admin->save()) {

            $this->sendResetPasswordEmail($attributes);

            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();
            }
            $admin = $this->model->find($admin->id);

//            if ($admin->level == 'admin') {
//                // user has one roles in my case
//                if (count($admin->roles) > 0) {
//                    $admin->detachRoles($admin->roles);
//                }
//
//                foreach ($attributes['role'] as $role)
//                    $admin->attachRole($role);
//            }


            return response_api(true, 200, trans('app.created'), $admin);

        }
        return response_api(false, 422, trans('app.not_created'));
    }

    public function sendResetPasswordEmail($request)
    {
        $response = Password::broker('admins')->sendResetLink(
            ['email' => $request['email']]
        );
//
//        return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
//            ? true
//            : false;
    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $admin = $this->model->find($id);

        if (isset($admin)) {
            $admin->is_active = !$admin->is_active;
            $admin->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement update() method.

        $admin = isset($id) ? $this->model->find($id) : \admin();
        if (isset($attributes['username']))
            $admin->username = $attributes['username'];
        if (isset($attributes['mobile']))
            $admin->mobile = $attributes['mobile'];
        if (isset($attributes['email']))
            $admin->email = $attributes['email'];
        if (isset($attributes['password']))
            $admin->password = bcrypt($attributes['password']);

        if ($admin->save()) {

            if (isset($attributes['logo'])) {
                $admin->logo = $this->storeImageThumb('admins', $admin->id, $attributes['logo']);
                $admin->save();
            }

            if (isset($attributes['roles']) && count($attributes['roles']) > 0) {
                AdminRole::where('admin_id', $admin->id)->forceDelete();
                foreach ($attributes['roles'] as $role) {
                    $admin_role = new AdminRole();
                    $admin_role->admin_id = $admin->id;
                    $admin_role->role_id = $role;
                    $admin_role->save();
                }
            }

            return response_api(true, 200, trans('app.updated'), $admin);

        }
        return response_api(false, 422, trans('app.not_updated'));
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $admin = $this->model->where('type', 'admin')->find($id);

        if (isset($admin) && $admin->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    function count()
    {
        return $this->model->count();
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ChangeStatusRequest;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Repositories\Eloquents\AdminEloquent;
use App\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    private $admin;

    public function __construct(AdminEloquent $adminEloquent)
    {
        $this->admin = $adminEloquent;
    }

    public function anyData()
    {
        return $this->admin->anyData();
    }

    public function profile($id = null)
    {
        $roles = Role::all();

        $admin = (isset($id)) ? $this->admin->getById($id) : admin();
        $data = [
            'sub_title' => 'Admins',
            'icon' => 'fa fa-users',
            'admin' => $admin,
            'roles' => $roles
        ];
        return view(admin_users_vw() . '.profile', $data);
    }


    public function index()
    {
        $data = [
            'sub_title' => 'Admins',
            'icon' => 'fa fa-users',
        ];

        return view(admin_users_vw() . '.admins', $data);
    }

    public function create()
    {
        $view = view()->make(modals('admins.add'), [
        ]);

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->admin->create($request->all());
    }

    public function edit($id)
    {
        $admin = $this->admin->getById($id);
        $view = view()->make(modals('admins.edit'), [
            'admin' => $admin
        ]);

        $html = $view->render();

        return $html;
    }

    public function changeStatus($id)
    {
        return $this->admin->changeStatus($id);
    }

    public function update(UpdateRequest $request, $id = null)
    {
        return $this->admin->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->admin->delete($id);
    }
}

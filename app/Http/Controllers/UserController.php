<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateOwnerRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Position;
use App\Repositories\Eloquents\UserEloquent;
use App\User;
use Illuminate\Http\Request;
use Password;
use Mail;

class UserController extends Controller
{
    //

    private $user;

    public function __construct(UserEloquent $userEloquent)
    {
        $this->user = $userEloquent;
        view()->share(['main_title' => 'Users management']);
    }

    public function anyData($type)
    {
        return $this->user->anyData($type);
    }

    public function index()
    {
        $data = [
            'sub_title' => 'Admins',
            'icon' => 'fa fa-users',
        ];

        return view(admin_users_vw() . '.index', $data);
    }

    public function create()
    {
        $cities = City::all();
        $view = view()->make(modals('users.add'), [
            'cities' => $cities
        ]);

        $html = $view->render();

        return $html;
    }

    public function store(CreateRequest $request)
    {
        return $this->user->store($request->all());
    }

    public function edit($id)
    {
        $user = User::find($id);
//        $cities = City::all();
//
//        $view = view()->make(modals('users.edit'), [
//            'user' => $user,
//            'cities' => $cities,
//        ]);
//
//        $html = $view->render();
//
//        return $html;

        if ($user->type == 'pitch_owner') {
            $data = [
                'sub_title' => 'Edit Pitch Owner',
                'icon' => 'fa fa-users',
                'pitch_owner' => $user,
                'cities' => City::all(),
                'positions' => Position::where('is_active', 1)->get(),
            ];
            return view(admin_users_vw() . '.editPitchOwner', $data);
        }

        $data = [
            'sub_title' => 'Edit Player',
            'icon' => 'fa fa-users',
            'player' => $user,
            'cities' => City::all(),
            'positions' => Position::where('is_active', 1)->get(),
        ];
        return view(admin_users_vw() . '.editPlayer', $data);
//
    }


    // edit player
    public function update(UpdateRequest $request, $id)
    {
        return $this->user->update($request->all(), $id);
    }

    // edit PitchOwner
    public function updateOwner(UpdateOwnerRequest $request, $id)
    {
        return $this->user->updateOwner($request->all(), $id);
    }

    public function changeStatus($id)
    {
        return $this->user->changeStatus($id);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }
}

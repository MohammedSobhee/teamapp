<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\Admin\Pitch\CreateRequest;
use App\Repositories\Eloquents\PitchEloquent;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    //
    private $pitch, $user;

    public function __construct(PitchEloquent $pitchEloquent, User $user)
    {
        $this->pitch = $pitchEloquent;
        $this->user = $user;
    }

    public function anyData()
    {
        return $this->pitch->anyData();
    }

    public function index()
    {
        return view(admin_pitches_vw() . '.index');
    }

    public function add()
    {
        $data = [
            'pitch_owners' => $this->user->where('type', 'pitch_owner')->where('is_active', 1)->get(),
            'services' => Service::all(),
            'cities' => City::all()
        ];
        return view(admin_pitches_vw() . '.add', $data);
    }

    public function store(CreateRequest $request)
    {
        return $this->pitch->create($request->all());
    }

    public function update(CreateRequest $request, $id)
    {
        return $this->pitch->update($request->all(), $id);
    }

    public function view($id)
    {
        return view(admin_pitches_vw() . '.view');

    }

    public function edit($id)
    {
        $pitch = $this->pitch->getByIdWithOutJson($id);
        $original = ['sat', 'sun', 'mon', 'tue', 'wed', 'thur', 'fri'];

        $schedules = $pitch->Schedules->groupBy('day')->map(function (){

        });

        $data = [
            'pitch_owners' => $this->user->where('type', 'pitch_owner')->where('is_active', 1)->get(),
            'services' => Service::all(),
            'cities' => City::all(),
            'schedules' => $schedules,
            'original' => $original,
            'pitch' => $pitch
        ];
        return view(admin_pitches_vw() . '.edit', $data);
    }

    public function delete($id)
    {
        return $this->pitch->delete($id);

    }
}

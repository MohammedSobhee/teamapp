<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\Admin\Match\UpdateRequest;
use App\Http\Requests\Match\AddRecordRequest;
use App\Pitch;
use App\Repositories\Eloquents\MatchEloquent;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    //
    private $match;

    public function __construct(MatchEloquent $matchEloquent)
    {
        $this->match = $matchEloquent;
    }

    public function index()
    {
        return view(admin_matches_vw() . '.index');
    }

    public function anyData()
    {
        return $this->match->anyData();
    }

    public function edit($id)
    {
        $match = $this->match->getById($id);
        if (!isset($match))
            return back();
        $data = [
            'match' => $match,
            'cities' => City::all(),
            'pitches' => Pitch::all(),
        ];


        return view(admin_matches_vw() . '.edit', $data);

    }


    public function update(UpdateRequest $request, $id)
    {
        return $this->match->update($request->all(), $id);
    }

    public function record(AddRecordRequest $request)
    {
        return $this->match->record($request->all());
    }

    public function deleteRecord($id)
    {
        return $this->match->deleteRecord($id);
    }


    public function view($id)
    {
        $match = $this->match->getById($id);

//        dd($match->Timeline()->orderBy('track_time','ASC')->get());
        if (!isset($match))
            return back();
        session()->put('league_id', $match->league_id);
        $data = [
            'match' => $match,
            'timeline' => $match->Timeline()->orderBy('track_time', 'ASC')->get(),
        ];
        return view(admin_matches_vw() . '.view', $data);

    }

    public function changeStatus($id)
    {
        return $this->match->changeStatus($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Group\CreateRequest;
use App\Repositories\Eloquents\GroupEloquent;

class GroupController extends Controller
{
    //
    private $group;

    public function __construct(GroupEloquent $groupEloquent)
    {
        $this->group = $groupEloquent;
    }


    public function LeagueGroupData()
    {
        return $this->group->LeagueGroupData(request()->get('league_id'));
    }

    public function postGroup(CreateRequest $request)
    {
        return $this->group->create($request->all());
    }

    public function deleteLeagueGroup($group_id)
    {
        return $this->group->delete($group_id);
    }

}

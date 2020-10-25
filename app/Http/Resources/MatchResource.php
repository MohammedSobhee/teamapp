<?php

namespace App\Http\Resources;

use App\Http\Resources\League\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'match_date_time' => $this->match_date_time,
            'team_one' => new TeamResource($this->TeamOne),
            'team_two' => new TeamResource($this->TeamTwo),
            'team_one_result' => $this->team_one_result,
            'team_two_result' => $this->team_two_result,
            'level' => $this->level,
            'city_name' => $this->city_name,
            'league_name' => $this->league_name,
            'group_name' => $this->group_name,
            'pitch_name' => isset($this->Pitch) ? $this->Pitch->name : '-',
        ];
    }
}

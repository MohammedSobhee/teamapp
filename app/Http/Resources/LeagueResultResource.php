<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($this->player_id)) {
            $id = $this->player_id;
            $type = 'player';
            $name = $this->Player->full_name;
            $logo = $this->Player->image;
        } else {
            $id = $this->team_id;
            $type = 'team';
            $name = $this->Team->name;
            $logo = $this->Team->logo;

        };
        return [
            'id' => $id,
            'type' => $type,
            'name' => $name,
            'result_type' => $this->ResultType->name,
            'logo' => $logo,
        ];
    }
}

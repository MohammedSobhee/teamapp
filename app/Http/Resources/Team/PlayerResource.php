<?php

namespace App\Http\Resources\Team;

use App\TeamPlayer;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $position = $this->primer_position;
        if (request()->has('team_id')) {
            $team_player = TeamPlayer::where('player_id', $this->id)->where('team_id', $request->get('team_id'))->first();
            if (isset($team_player)) {
                $position = $team_player->position_name;
            }
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nick_name' => $this->nick_name,
            'height' => $this->height,
            'weight' => $this->weight,
            'favorite_leg' => $this->favorite_leg,
            'type' => $this->type,
            'image' => $this->image,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'is_complete_profile' => $this->is_complete_profile,
            'primer_position_id' => $this->primer_position_id,
            'secondary_position_id' => $this->secondary_position_id,
            'primer_position' => $position,
            'secondary_position' => $this->secondary_position,
            'image100' => $this->image100,
            'image300' => $this->image300,
        ];
    }
}

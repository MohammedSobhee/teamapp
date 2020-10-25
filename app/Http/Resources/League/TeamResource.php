<?php

namespace App\Http\Resources\League;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'logo' => $this->logo,
            'name' => $this->name,
            'is_my_team' => (auth()->check() && $this->coach_id == auth()->user()->id) ? true : false,
        ];
    }
}

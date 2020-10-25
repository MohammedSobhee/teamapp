<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerStatsResource extends JsonResource
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
//            'id' => $this->id,
//            'name' => $this->name,
            'stats_name' => $this->name,
            'value' => $this->avg_value,
        ];
    }
}

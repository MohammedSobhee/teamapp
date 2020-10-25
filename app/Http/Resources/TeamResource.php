<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'logo' => $this->logo,
            'bg_image' => $this->bg_image,
            "pm" => intval($this->pivot->pm),
            "w" => intval($this->pivot->w),
            "d" => intval($this->pivot->d),
            "l" => intval($this->pivot->l),
            "gf" => intval($this->pivot->gf),
            "ga" => intval($this->pivot->ga),
            "gd" => intval($this->pivot->gd),
            "pts" => intval($this->pivot->pts),
        ];
    }
}

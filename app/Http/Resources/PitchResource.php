<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PitchResource extends JsonResource
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
            'city_name' => $this->city_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'description' => $this->description,
            'cost_hour' => $this->cost_hour,
            'discount' => $this->discount,
            'rates' => $this->rates,
            'pitch_owner' => new UserResource($this->Owner),
            'services' => $this->services,
            'schedules' => $this->schedules,
            'sizes' => $this->sizes,
            'images' => $this->images,
        ];
    }
}

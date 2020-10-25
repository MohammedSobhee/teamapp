<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pitch extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['city_name','rates', 'owner', 'services', 'schedules', 'sizes', 'images'];

    public function Owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function Images()
    {
        return $this->hasMany(PitchImage::class, 'pitch_id', 'id');
    }

    public function Services()
    {
        return $this->belongsToMany(Service::class, 'pitch_services', 'pitch_id', 'service_id')->whereNull('pitch_services.deleted_at');
    }

    public function Schedules()
    {
        return $this->hasMany(PitchSchedule::class, 'pitch_id', 'id');
    }

    public function Sizes()
    {
        return $this->hasMany(PitchSize::class, 'pitch_id', 'id');
    }

    public function Rates()
    {
        return $this->hasMany(PitchRate::class, 'pitch_id', 'id');
    }

    public function getOwnerAttribute()
    {
        return $this->Owner()->first();
    }

    public function getCityNameAttribute()
    {
        return $this->City()->first()->name;
    }

    public function getServicesAttribute()
    {
        return $this->Services()->get();
    }

    public function getSchedulesAttribute()
    {
        return $this->Schedules()->get();
    }

    public function getSizesAttribute()
    {
        return $this->Sizes()->get();
    }

    public function getImagesAttribute()
    {
        return $this->Images()->get();
    }

    public function getRatesAttribute()
    {
        return $this->Rates()->avg('rate');
    }
}

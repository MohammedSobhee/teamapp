<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PitchSchedule extends Model
{
    //
    use SoftDeletes;
    protected $appends = ['day_name'];

    public function getDayNameAttribute()
    {
        return trans('app.days.' . $this->day);
    }
}

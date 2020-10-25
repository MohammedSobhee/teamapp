<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamPlayer extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['position_name'];

    public function Position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function getPositionNameAttribute()
    {
        return $this->Position()->withTrashed()->first()->name;
    }

}

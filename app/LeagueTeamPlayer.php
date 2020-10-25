<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeagueTeamPlayer extends Model
{
    //
    use SoftDeletes;

    protected $casts = ['league_id' => 'integer', 'team_id' => 'integer', 'player_id' => 'integer', 'player_no' => 'integer', 'position_id' => 'integer'];


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

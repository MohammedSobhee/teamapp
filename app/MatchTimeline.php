<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchTimeline extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['player','substituted_player', 'icon'];

//    private $icons = ['icon-football', 'card yellow', 'card red', 'la la-arrow-up', 'la la-arrow-down'];

    public function Player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function SubstitutedPlayer()
    {
        return $this->belongsTo(User::class, 'substituted_player_id');
    }

    public function getPlayerAttribute()
    {
        return $this->Player()->first();
    }

    public function getSubstitutedPlayerAttribute()
    {
        return $this->SubstitutedPlayer()->first();
    }

    public function getIconAttribute()
    {
        if ($this->track_type == 'goal')
            return '<i class="icon-football"></i>';
        if ($this->track_type == 'yellow_card')
            return '<i class="card yellow"></i>';
        if ($this->track_type == 'red_card')
            return '<i class="card red"></i>';
        if ($this->track_type == 'substitution')
            return '<i class="la la-arrow-up"></i><i class="la la-arrow-down"></i>';

    }
}

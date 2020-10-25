<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeagueTeamGroup extends Model
{
    //
    use SoftDeletes;

    protected $casts = [
        'league_group_id' => 'integer',
        'team_id' => 'integer',
        'pm' => 'integer',
        'w' => 'integer',
        'd' => 'integer',
        'l' => 'integer',
        'gf' => 'integer',
        'ga' => 'integer',
        'gd' => 'integer',
        'pts' => 'integer',
    ];

    public function Team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

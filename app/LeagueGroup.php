<?php

namespace App;

use App\Http\Resources\TeamResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeagueGroup extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['group_name', 'teams'];

//    protected $hidden = ['pivot'];
    protected $casts = [
        'league_id' => 'integer'
    ];

    public function Teams()
    {
        return $this->belongsToMany(Team::class, 'league_team_groups', 'league_group_id', 'team_id')->withPivot(['pm', 'w', 'd', 'l', 'gf', 'ga', 'gd', 'pts'])->whereNull('league_team_groups.deleted_at');
    }

    public function Matches()
    {
        return $this->hasMany(Match::class, 'group_id', 'id');
    }

//
    public function getTeamsAttribute()
    {
        return $this->Teams()->get()->makeHidden('pivot');
    }

    public function getGroupNameAttribute()
    {
        return $this->name . ' المجموعة';
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            LeagueTeamGroup::where('league_group_id', $model->id)->delete();
            $model->Matches()->delete();
        });
    }

}

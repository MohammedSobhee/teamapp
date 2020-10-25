<?php

namespace App;

use App\Http\Resources\League\TeamResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    //
    use SoftDeletes;

//    protected $with = ['TeamOne', 'TeamTwo'];

    protected $appends = ['city_name', 'league_name', 'group_name', 'match_date'];

    protected $casts = ['team_one_result' => 'integer', 'team_two_result' => 'integer', 'level' => 'integer'];

    public function Timeline()
    {
        return $this->hasMany(MatchTimeline::class, 'match_id', 'id');
    }

    public function TeamOne()
    {
        return $this->belongsTo(Team::class, 'team_one_id');
    }

    public function TeamTwo()
    {
        return $this->belongsTo(Team::class, 'team_two_id');
    }

    public function League()
    {
        return $this->belongsTo(League::class, 'league_id');

    }

    public function Group()
    {
        return $this->belongsTo(LeagueGroup::class, 'group_id');

    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');

    }

    public function Pitch()
    {
        return $this->belongsTo(Pitch::class, 'pitch_id');
    }

//    public function getTeamOneAttribute()
//    {
//        return new TeamResource($this->TeamOne()->withTrashed()->first());
//    }
//
//    public function getTeamTwoAttribute()
//    {
//        return new TeamResource($this->TeamTwo()->withTrashed()->first());
//    }

    public function getMatchDateAttribute()
    {
        return Carbon::parse($this->match_date_time)->format('d/m/Y');
    }

    public function getCityNameAttribute()
    {
        return $this->City()->withTrashed()->first()->name;
    }

    public function getLeagueNameAttribute()
    {
        $league = $this->League()->withTrashed()->first();
        return isset($league) ? $league->name : '-';
    }

    public function getGroupNameAttribute()
    {
        $group = $this->Group()->withTrashed()->first();
        return isset($group) ? $group->name : '-';
    }
}

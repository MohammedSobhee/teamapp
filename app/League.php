<?php

namespace App;

use App\Http\Resources\GroupResource;
use App\Http\Resources\League\TeamResource;
use App\Http\Resources\LeagueResultResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class League extends Model
{
    //
    use SoftDeletes;

    protected $appends = ['logo100', 'logo300', 'city_name', 'type_name', 'participant_teams', 'groups', 'groups_result', 'results', 'next_group'];
    protected $casts = ['city_id' => 'integer', 'teams_no' => 'integer', 'main_player_no' => 'integer', 'reserved_player_no' => 'integer'];

    public function getLogo100Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/leagues/' . $this->id) . '/100/' . $this->attributes['logo'];
        return url('assets/img/league.jpg');
    }

    public function getLogo300Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/leagues/' . $this->id) . '/300/' . $this->attributes['logo'];
        return url('assets/img/league.jpg');
    }

    public function getLogoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/leagues/' . $this->id) . '/' . $value;
        return url('assets/img/league.jpg');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function Groups()
    {
        return $this->hasMany(LeagueGroup::class, 'league_id', 'id');
    }

    public function Matches()
    {
        return $this->hasMany(Match::class, 'league_id', 'id');
    }

    public function Results()
    {
        return $this->hasMany(Result::class, 'ref_id', 'id')->where('results.type', 'league');
    }

    public function Teams()
    {
        return $this->belongsToMany(Team::class, 'league_teams', 'league_id', 'team_id', 'id', 'id')->whereNull('league_teams.deleted_at');
    }

    public function getParticipantTeamsAttribute()
    {
        return TeamResource::collection($this->Teams()->get());
    }

    public function getCityNameAttribute()
    {
        $city = $this->City()->first();
        if (isset($city))
            return $city->name;
    }

    public function getGroupsAttribute()
    {
        if ($this->type == 'tournament')
            return $this->Groups()->orderBy('name')->get();
        return [];
    }

    public function getGroupsResultAttribute()
    {
        if ($this->type == 'tournament')
            return GroupResource::collection($this->Groups()->orderBy('name')->get());
        return [];

    }

    public function getResultsAttribute()
    {
        return LeagueResultResource::collection($this->Results()->get());
    }

    public function getNextGroupAttribute()
    {
        if ($this->type == 'tournament') {
            $group = $this->Groups()->orderByDesc('name')->first();
            if (isset($group))
                return ++$group->name;
            return 'A';
        }
    }

//    public function getStatusAttribute()
//    {
//        if ($this->date_from > Carbon::now()->format('Y-m-d'))
//            return 'new';
//        if ($this->date_from <= Carbon::now()->format('Y-m-d') && $this->date_to >= Carbon::now()->format('Y-m-d'))
//            return 'current';
//        if ($this->date_to < Carbon::now()->format('Y-m-d'))
//            return 'finished';
//    }

    public function getTypeNameAttribute()
    {
        if ($this->type == 'cup')
            return 'كأس';
        return 'دوري';
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/leagues/' . $model->id . '/' . $model->attributes['logo']);
            $filename100 = storage_path('app/leagues/' . $model->id . '/100/' . $model->attributes['logo']);
            $filename300 = storage_path('app/leagues/' . $model->id . '/300/' . $model->attributes['logo']);
//
            if (file_exists($filename)) {
                unlink($filename);
                unlink($filename100);
                unlink($filename300);
                $model->delete();
            }

        });
    }
}

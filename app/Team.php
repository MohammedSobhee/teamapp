<?php

namespace App;

use App\Http\Resources\CaptainResource;
use App\Http\Resources\CoachResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $appends = ['leagues_num', 'city_name', 'type_name', 'league_wins', 'match_wins', 'logo100', 'logo300', 'bg_image100', 'bg_image300', 'player_num', 'players', 'coach', 'captain'];

    protected $casts = [
        'players_num' => 'integer', 'city_id' => 'integer', 'coach_id' => 'integer', 'captain_id' => 'integer', 'pm' => 'integer',
        'w' => 'integer', 'd' => 'integer', 'l' => 'integer', 'gf' => 'integer', 'ga' => 'integer', 'gd' => 'integer', 'pts' => 'integer'];

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function Coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function Captain()
    {
        return $this->belongsTo(User::class, 'captain_id');
    }

    public function LeagueWins()
    {
        return $this->hasMany(League::class, 'team_win_id', 'id');
    }

    public function MatchWins()
    {
        return $this->hasMany(Match::class, 'team_win_id', 'id');
    }

    public function Players()
    {
        return $this->belongsToMany(User::class, 'team_players', 'team_id', 'player_id')->where('team_players.status','exist')->whereNull('team_players.deleted_at');
    }

    public function LeaguePlayers()
    {
        return $this->belongsToMany(User::class, 'league_team_players', 'team_id', 'player_id')->whereNull('league_team_players.deleted_at')->withPivot(['player_no', 'position_id']);
    }

    public function MatchTeamOnes()
    {
        return $this->hasMany(Match::class, 'team_one_id', 'id');
    }

    public function MatchTeamTwos()
    {
        return $this->hasMany(Match::class, 'team_two_id', 'id');
    }

    public function Leagues()
    {
        return $this->belongsToMany(League::class, 'league_teams', 'team_id', 'league_id')->whereNull('league_teams.deleted_at')->withPivot('status');
    }

    public function getCaptainAttribute()
    {
        $captain = $this->Captain()->first();
        if (isset($captain))
            return new CaptainResource($captain);
    }

    public function getCoachAttribute()
    {
        $coach = $this->Coach()->first();
        if (isset($coach))
            return new CoachResource($coach);
    }

    public function getPlayersAttribute()
    {
        request()->request->add(['team_id' => $this->id]);
        return $this->Players()->get();
    }

    public function getLeaguesNumAttribute()
    {
        return $this->Leagues()->where('league_teams.status', 'approved')->count();
    }

    public function getLeagueWinsAttribute()
    {
        return $this->LeagueWins()->count();
    }

    public function getMatchWinsAttribute()
    {
        return $this->MatchWins()->count();
    }


    public function getPlayerNumAttribute()
    {
        return $this->Players()->count();
    }


    public function getCityNameAttribute()
    {
        return $this->City()->first()->name;
    }


    public function getLogo100Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/teams/' . $this->id) . '/100/' . $this->attributes['logo'];
        return url('assets/img/team.png');
    }

    public function getLogo300Attribute()
    {
        if (isset($this->attributes['logo']))
            return url('storage/app/teams/' . $this->id) . '/300/' . $this->attributes['logo'];
        return url('assets/img/team.png');
    }

    public function getLogoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/teams/' . $this->id) . '/' . $value;
        return url('assets/img/team.png');
    }

    public function getBgImage100Attribute()
    {
        if (isset($this->attributes['bg_image']))
            return url('storage/app/teams/' . $this->id) . '/100/' . $this->attributes['bg_image'];
        return null;
    }

    public function getBgImage300Attribute()
    {
        if (isset($this->attributes['bg_image']))
            return url('storage/app/teams/' . $this->id) . '/300/' . $this->attributes['bg_image'];
        return null;
    }

    public function getBgImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/teams/' . $this->id) . '/' . $value;
        return null;
    }

    public function getTypeNameAttribute()
    {
        return trans('app.types.' . $this->type);
    }
}

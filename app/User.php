<?php

namespace App;

use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'country_id' => 'integer', 'city_id' => 'integer', 'primer_position_id' => 'integer', 'secondary_position_id' => 'integer', 'height' => 'double', 'weight' => 'double', 'is_confirm_code' => 'integer', 'is_complete_profile' => 'boolean', 'is_active' => 'integer', 'commission' => 'double', 'discount' => 'double'
    ];


    protected $appends = ['full_name', 'city', 'country', 'primer_position', 'secondary_position', 'image100', 'image300'];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function findForPassport($identifier)
    {
        return $this->orWhere('username', $identifier)->orWhere('email', $identifier)->orWhere('mobile', $identifier)->first();
    }

    public function getImage100Attribute()
    {
        if (isset($this->attributes['image']))
            return url('storage/app/users/' . $this->id) . '/100/' . $this->attributes['image'];
        return url('assets/img/placeholder-user.png');
    }

    public function getImage300Attribute()
    {
        if (isset($this->attributes['image']))
            return url('storage/app/users/' . $this->id) . '/300/' . $this->attributes['image'];
        return url('assets/img/placeholder-user.png');
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/users/' . $this->id) . '/' . $value;
        return url('assets/img/placeholder-user.png');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function TimeLine()
    {
        return $this->hasMany(MatchTimeline::class, 'player_id','id');
    }

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function PrimerPosition()
    {
        return $this->belongsTo(Position::class, 'primer_position_id');
    }

    public function Rates()
    {
        return $this->belongsToMany(RateType::class, 'player_rates', 'player_id', 'rate_type_id')->whereNull('player_rates.deleted_at')->withPivot(['rate']);
    }

    public function Stats()
    {
        return $this->belongsToMany(Stats::class, 'player_stats', 'player_id', 'stats_id')->whereNull('player_stats.deleted_at')->withPivot(['value']);
    }

    public function SecondaryPosition()
    {
        return $this->belongsTo(Position::class, 'secondary_position_id');
    }

    public function getPrimerPositionAttribute()
    {
        if (request()->has('league_id') || session()->has('league_id')) {
            if (session()->has('league_id'))
                $league_team_player = LeagueTeamPlayer::where('player_id', $this->id)->where('league_id', session()->get('league_id'))->first();
            else
                $league_team_player = LeagueTeamPlayer::where('player_id', $this->id)->where('league_id', request()->get('league_id'))->first();

            if (isset($league_team_player))
                return $league_team_player->position_name;
        }
        if (request()->has('team_id')) {
            $team_player = TeamPlayer::where('player_id', $this->id)->where('team_id', request()->get('team_id'))->first();

            if (isset($team_player))
                return $team_player->position_name;
        }
        $primer_position = $this->PrimerPosition()->first();
        return isset($primer_position) ? $primer_position->name : null;
    }

    public function getSecondaryPositionAttribute()
    {
        $secondary_position = $this->SecondaryPosition()->first();
        return isset($secondary_position) ? $secondary_position->name : null;
    }

    public function getCityAttribute()
    {
        $city = $this->City()->first();
        if (isset($city))
            return new CityResource($city);
    }

    public function getCountryAttribute()
    {
        $country = $this->Country()->first();
        if (isset($country))
            return new CountryResource($country);
    }
}

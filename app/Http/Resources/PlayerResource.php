<?php

namespace App\Http\Resources;

use App\LeagueTeamPlayer;
use App\Match;
use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

//        $player_stats = $this->Stats()->select('player_id', 'stats_id', 'stats.name', DB::raw('ROUND(AVG(player_stats.value)) as avg_value'))->groupBy('player_stats.player_id', 'player_stats.stats_id', 'stats.name')->get();

        $team_ids = LeagueTeamPlayer::where('player_id', $this->id)->pluck('team_id')->unique();
        $matches_num = Match::where(function ($query) use ($team_ids) {
            $query->whereIn('team_one_id',$team_ids)->orWhere('team_two_id',$team_ids);
        })->count();
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'nick_name' => $this->nick_name,
            'full_name' => $this->full_name,
            'birth_date' => $this->birth_date,
            'image' => $this->image,
            'image100' => $this->image100,
            'image300' => $this->image300,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'primer_position_id' => $this->primer_position_id,
            'secondary_position_id' => $this->secondary_position_id,
            'height' => $this->height,
            'weight' => $this->weight,
            'verification_code' => $this->verification_code,
            'is_confirm_code' => $this->is_confirm_code,
            'favorite_leg' => $this->favorite_leg,
            'type' => $this->type,
            'is_active' => $this->is_active,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'bio' => $this->bio,
            'commission' => $this->commission,
            'discount' => $this->discount,
            'is_complete_profile' => $this->is_complete_profile,
            'created_at' => $this->created_at,
            'city' => $this->city,
            'country' => $this->country,
            'primer_position' => $this->primer_position,
            'secondary_position' => $this->secondary_position,
            'matches_num' => $matches_num,
            'goals_num' => $this->TimeLine()->where('track_type','goal')->count(),
            'speed' => round($this->Stats()->where('stats_id', 1)->average('value')),// السرعة
            'shuffle' => round($this->Stats()->where('stats_id', 6)->average('value')), // المراوغة
            'shooting' => round($this->Stats()->where('stats_id', 2)->average('value')), // التسديد
            'control_ball' => round($this->Stats()->where('stats_id', 7)->average('value')), // السيطرة على الكرة
            'pass' => round($this->Stats()->whereIn('stats_id', [4, 5])->average('value')), // تمريرة
            'physical_strength' => round($this->Stats()->where('stats_id', 9)->average('value')), // القوة البدنية
            'assist' => round($this->Stats()->where('stats_id', 11)->average('value')), // القوة البدنية
            'skill' => round($this->Stats()->where('stats_id', 10)->average('value')), // المهارات (بواسطة 5 نجوم)
//            'rates' => $this->Rates()->get(),
//            'stats' => PlayerStatsResource::collection($player_stats),
        ];
    }
}

<?php

namespace App\Http\Requests\Match;

use Illuminate\Foundation\Http\FormRequest;

class AddRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'goal','yellow_card','red_card','penalty_kick','substitution','penalty_lose'
            //`track_type`, `player_id`, `team_id`, `match_id`, `track_time`, `substituted_player_id`
            'track_type' => 'required|in:goal,yellow_card,red_card,penalty_kick,substitution,penalty_lose',
            'player_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:teams,id',
            'match_id' => 'required|exists:matches,id',
            'track_time' => 'required|numeric',
            'substituted_player_id' => 'nullable|exists:users,id',
        ];
    }

    // attributes
}

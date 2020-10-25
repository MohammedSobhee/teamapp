<?php

namespace App\Http\Requests\Api\Team;

use Illuminate\Foundation\Http\FormRequest;

class JoinLeagueRequest extends FormRequest
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
        $this->request->add(['players_' => json_decode(request()->get('players'))]);//

        return [
            //
            'team_id' => 'required|exists:teams,id',
            'league_id' => 'required|exists:leagues,id',
            'players_.*.player_id' => 'required|exists:users,id',
            'players_.*.player_no' => 'required|numeric|gt:0',
            'players_.*.position_id' => 'required|exists:positions,id',

        ];
    }
}

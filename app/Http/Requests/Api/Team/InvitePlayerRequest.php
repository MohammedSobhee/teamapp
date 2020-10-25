<?php

namespace App\Http\Requests\Api\Team;

use Illuminate\Foundation\Http\FormRequest;

class InvitePlayerRequest extends FormRequest
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
            //
            'team_id' => 'required|exists:teams,id',
            'players' => 'required',
            'players.*.player_id' => 'required|exists:users,id,is_active,1,type,player',
//            'players.*.position_id' => 'required|exists:positions,id',
        ];
    }

    public function attributes()
    {
        return [
            'players' => 'الاعب',
            'players.*.player_id' => 'الاعب',
//            'players.*.position_id' => 'موقع الاعب',
        ];
    }
}

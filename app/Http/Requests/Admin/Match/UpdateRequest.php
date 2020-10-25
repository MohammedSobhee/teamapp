<?php

namespace App\Http\Requests\Admin\Match;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'team_one_id' => 'required|exists:teams,id',
            'team_two_id' => 'required|exists:teams,id',
            'team_one_result' => 'required|integer',
            'team_two_result' => 'required|integer',
            'city_id' => 'required|exists:cities,id',
            'match_date_time' => 'required|date_format:Y-m-d H:i:s',
            'pitch_id' => 'required|exists:pitches,id',
        ];
    }
}

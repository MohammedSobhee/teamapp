<?php

namespace App\Http\Requests\Admin\League;

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
            'league_id' => 'required|exists:leagues,id',
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'type' => 'required|in:cup,tournament',
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d|after:date_from',
            'registration_deadline' => 'required|date_format:Y-m-d|before:date_from',
            'teams_no' => 'required|numeric',
            'main_player_no' => 'required|numeric',
            'reserved_player_no' => 'required|numeric',
            'payment_type' => 'required|in:paid,free',
            'payment_cost' => 'required_if:payment_type,paid',
        ];
    }
}

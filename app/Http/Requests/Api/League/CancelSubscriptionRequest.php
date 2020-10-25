<?php

namespace App\Http\Requests\Api\League;

use Illuminate\Foundation\Http\FormRequest;

class CancelSubscriptionRequest extends FormRequest
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
            'team_id' => 'required|exists:teams,id,coach_id,' . auth()->user()->id,
            'league_id' => 'required|exists:leagues,id',
        ];
    }
}

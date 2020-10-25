<?php

namespace App\Http\Requests\Api\Team;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
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
            'is_all' => 'nullable|in:0,1',
            'league_id' => 'nullable|exists:leagues,id',
            'type' => 'nullable|in:my_team,other_teams,all_my_team',
            'page_size' => 'nullable|numeric|gt:0',
            'page_number' => 'nullable|numeric|gt:0',
        ];
    }
}

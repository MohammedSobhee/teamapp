<?php

namespace App\Http\Requests\Admin\Group;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        $teams = explode(',', $this->request->get('teams_id')[0]);
        $this->request->add(['teams_id' => $teams]);

        return [
            //
            'league_id' => 'required|exists:leagues,id,type,tournament',
            'teams_id.*' => 'required|exists:teams,id'
        ];
    }

    public function attributes()
    {
        return [
            'league_id'=>'اسم البطولة',
            'teams_id.*'=>'الفرق',
        ];
    }
}

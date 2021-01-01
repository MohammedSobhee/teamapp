<?php

namespace App\Http\Requests\Api\Team;

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

        if (request()->has('players'))
            $this->request->add(['players_' => json_decode(request()->get('players'))]);//

        return [
            //
            'name' => 'required',
            'type' => 'required|in:public,invite',
            'city_id' => 'required|exists:cities,id',
            'logo' => 'nullable|image',
            'bg_image' => 'nullable|image',
            'players' => 'required',
            'players_.*.player_id' => 'required|exists:users,id,is_active,1,type,player',
            'players_.*.position_id' => 'nullable|exists:positions,id',
        ];
    }
}

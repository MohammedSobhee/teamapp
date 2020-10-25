<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        $id = auth()->user()->id;
        return [
            //
            'first_name'=> 'nullable',
            'last_name' => 'nullable',
            'nick_name' => 'nullable',
            'mobile'    => 'nullable|numeric|digits:12|unique:users,mobile,' . $id,
            'username'  => 'nullable|unique:users,username,' . $id,
            'email'     => 'nullable|email|unique:users,email,' . $id,
            'password'  => 'nullable|min:6',
            'old_password' => 'nullable|min:6',
            'country_id'   => 'nullable|exists:countries,id',
            'city_id'      => 'nullable|exists:cities,id',
            'primer_position_id'    => 'nullable|exists:positions,id',
            'secondary_position_id' => 'nullable|exists:positions,id',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'favorite_leg' => 'nullable|in:left,right',
            'birth_date'   => 'nullable|date_format:Y-m-d',
            'image' => 'nullable|image',
        ];
    }
}

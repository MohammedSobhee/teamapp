<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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

            'image' => 'nullable|image',
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'nick_name' => 'required',
            'mobile' => 'required|numeric|digits:12|unique:users,mobile',
            'username' => 'required|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    }
}

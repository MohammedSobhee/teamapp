<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmCodeRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'mobile' => 'required|numeric|digits:12', // if doesn't exist I update mobile number
            'verification_code' => 'required|digits:4',
            'password' => 'required|min:6',
            'device_type'=>'required|in:android,ios',
            'device_token'=>'required',
            'device_id'=>'sometimes',
        ];
    }
}

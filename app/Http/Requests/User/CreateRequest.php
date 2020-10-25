<?php

namespace App\Http\Requests\User;

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
        return [
            //
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'image' => 'nullable|image',
            'type' => 'required|in:pitch_owner,player',
            'mobile' => 'required|digits:12|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function attributes()
    {
        return [
            'name'=>'الاسم كامل',
            'username'=>'اسم المستخدم',
            'image'=>'الصورة',
            'type'=>'نوع المستخدم',
            'mobile'=>'رقم الجوال',
            'email'=>'البريد الالكتروني',
            'city_id'=>'المدينة',
        ];
    }
}

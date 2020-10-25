<?php

namespace App\Http\Requests\Admin;

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
            'username' => 'required|unique:admins,username',
            'mobile' => 'required|unique:admins,mobile',
            'email' => 'required|email|unique:admins,email',
            'logo' => 'nullable|image',
        ];
    }

    public function attributes()
    {
        return [
            'username'=>'اسم المستخدم',
            'logo'=>'الصورة',
            'mobile'=>'رقم الجوال',
            'email'=>'البريد الالكتروني',
        ];
    }
}

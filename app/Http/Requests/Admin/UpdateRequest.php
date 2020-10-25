<?php

namespace App\Http\Requests\Admin;

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

        $id = request()->route('id');
        $id = isset($id) ? $id : admin()->id;
        return [
            //
            'username' => 'required|unique:admins,username,' . $id,
            'mobile' => 'required|unique:admins,mobile,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'logo' => 'nullable|image',
            'password' => 'nullable|min:6|confirmed',
            'roles.*' => 'nullable|exists:roles,id',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'اسم المستخدم',
            'logo' => 'الصورة',
            'mobile' => 'رقم الجوال',
            'email' => 'البريد الالكتروني',
            'password' => 'كلمة المرور',
            'password_confirmation' => 'تأكيد كلمة المرور',
            'roles' => 'الصلاحيات',
        ];
    }
}

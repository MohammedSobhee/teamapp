<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOwnerRequest extends FormRequest
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
        return [
            //
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'image' => 'nullable|image',
//            'type' => 'required|in:pitch_owner,player',
            'mobile' => 'required|digits:12|unique:users,mobile,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'city_id' => 'required|exists:cities,id',
            'password' => 'nullable|min:6|confirmed',
            'discount' => 'nullable|numeric|gte:0',
            'commission' => 'nullable|numeric|gte:0',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'الاسم كامل',
            'username' => 'اسم المستخدم',
            'image' => 'الصورة',
            'type' => 'نوع المستخدم',
            'mobile' => 'رقم الجوال',
            'email' => 'البريد الالكتروني',
            'city_id' => 'المدينة',
            'commission' => 'نسبة العمولة',
            'discount' => 'مبلغ الخصم بعد الإلغاء',
            'password' => 'كلمة المرور',
            'password_confirmation' => 'تأكيد كلمة المرور',
        ];
    }
}

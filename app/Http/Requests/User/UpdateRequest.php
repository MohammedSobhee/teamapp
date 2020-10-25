<?php

namespace App\Http\Requests\User;

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


//`username`, `first_name`, `last_name`, `nick_name`, `birth_date`, `image`, `country_id`, `city_id`, `address`, `primer_position_id`, `secondary_position_id`, `height`, `weight`, `verification_code`, `is_confirm_code`, `favorite_leg`, `type`, `is_active`, `email`, `email_verified_at`, `mobile`, `password`, `bio`, `commission`, `discount`, `is_complete_profile`
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
            'birth_date' => 'required|date_format:Y-m-d',
            'city_id' => 'required|exists:cities,id',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'primer_position_id' => 'required|exists:positions,id',
            'secondary_position_id' => 'required|exists:positions,id',
            'bio' => 'nullable',
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
        ];
    }
}

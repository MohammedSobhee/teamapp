<?php

namespace App\Http\Requests\Admin\Pitch;

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
            'owner_id' => 'required|exists:pitches,id',
            'city_id' => 'required|exists:cities,id',
            'is_schedule.*' => 'required|in:sat,sun,mon,tue,wed,thur,fri',
            'services.*' => 'nullable|exists:services,id',
            'size.*' => 'required',
            'cost_hour' => 'required|numeric',
            'discount' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'files.*' => 'nullable|image',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'اسم الملعب',
            'owner_id' => 'مالك الملعب',
            'city_id' => 'المدينة',
            'is_schedule.*' => 'ايام العمل',
            'size.*' => 'مساحة الملعب',
            'services.*' => 'الخدمات',
            'cost_hour' => 'السعر/الساعة',
            'discount' => 'الخصم',
            'latitude' => 'العنوان على الخارطة',
            'files' => 'صور الملعب',
        ];
    }
}

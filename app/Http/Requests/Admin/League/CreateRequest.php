<?php

namespace App\Http\Requests\admin\League;

use Carbon\Carbon;
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
            'city_id' => 'required|exists:cities,id',
            'type' => 'required|in:cup,tournament',
            'date_from' => 'required|date_format:Y-m-d|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'date_to' => 'required|date_format:Y-m-d|after:date_from',
            'registration_deadline' => 'required|date_format:Y-m-d|before:date_from|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'teams_no' => 'required|numeric',
            'main_player_no' => 'required|numeric',
            'reserved_player_no' => 'required|numeric',
            'payment_type' => 'required|in:paid,free',
            'payment_cost' => 'required_if:payment_type,paid',

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'إسم البطولة',
            'city_id' => 'المدينة',
            'type' => 'نوع البطولة',
            'date_from' => 'تاريخ البداية',
            'date_to' => 'تاريخ النهاية',
            'registration_deadline' => 'تاريخ نهاية التسجيل',
            'teams_no' => 'عدد الفرق',
            'main_player_no' => 'اللاعبين الأساسيين',
            'reserved_player_no' => 'اللاعبين الاحتياطيين',
            'payment_type' => 'اشتراك البطولة',
            'payment_cost' => 'السعر',
        ];
    }
}

<?php

namespace App\Http\Requests\Api\League;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
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

            'type' => 'nullable|in:current,finished',
            'page_size' => 'nullable|numeric|gt:0',
            'page_number' => 'nullable|numeric|gt:0',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Articles;

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
        $rules = [
            //
            'title' => 'required',
            'media_type' => 'required|in:image,video',
            'published_date' => 'required|date_format:Y-m-d',

        ];

        if ($this->request->has('media_type')) {
            if ($this->request->get('media_type') == 'image') {
                $rules['media_image'] = 'required|image';
            } else {
                $rules['media_video'] = 'required|url';

            }
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => 'العنوان',
            'media_type' => 'نوع المرفق',
            'published_date' => 'التاريخ',
            'media_image' => 'الصورة',
            'media_video' => 'رابط الفيديو',
        ];
    }
}

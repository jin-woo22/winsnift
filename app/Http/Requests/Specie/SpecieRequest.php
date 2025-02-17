<?php

namespace App\Http\Requests\Specie;

use Illuminate\Foundation\Http\FormRequest;

class SpecieRequest extends FormRequest
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
        return match($this->method()) {
            
            'POST' => [
                'category_id' => ['required'],
                'scientific_name' => ['required'],
                'generic_name' => ['required'],
                'family' => ['required'],
                'description' => ['required'],
                // 'featured_photo' => ['required'],
            ],
            'PUT' => [
                'category_id' => ['required'],
                'scientific_name' => ['required'],
                'generic_name' => ['required'],
                'family' => ['required'],
                'description' => ['required'],
                'featured_photo' => ['sometimes'],
            ],
        };
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required',
            'featured_photo.required' => 'Please upload a featured photo',
        ];
    }
}
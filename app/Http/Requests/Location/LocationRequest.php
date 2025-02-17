<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'name' => ['required'],
                'specie_id' => ['required'],
                'plant_uniqid' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
            ],
            'PUT' => [
                'name' => ['required'],
                'specie_id' => ['required',],
                'plant_uniqid' => ['required',],
                'latitude' => ['required'],
                'longitude' => ['required'],
            ]
        };

    }

    public function messages()
    {
        return [
            'name.unique' => 'The plant already exist'
        ];
    }
}
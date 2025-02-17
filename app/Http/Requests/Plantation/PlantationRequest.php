<?php

namespace App\Http\Requests\Plantation;

use Illuminate\Foundation\Http\FormRequest;

class PlantationRequest extends FormRequest
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
            'location_id' => ['required'],
            'collection_date' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'longitude' => ['required'],
            'planted_at' => ['required'],
            'seeds' => 'required|min:0',
            'seedlings' => 'required|min:0',
            'wildlings' => 'required|min:0',
            'cuttings' => 'required|min:0',
            'marcotted' => 'required|min:0',    
            'plantation_site' => ['required'],
            'code' => ['required'],
            'no_accessions' => 'required|min:0'
        ];
    }

    public function messages()
    {
        return [
            'location_id.required' => 'The plant field is required.',
            'planted_at.required' => 'The date planted field is required.',
        ];
    }
}

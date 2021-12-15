<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadUpdateRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'name' => ['required', 'max:255', 'string'],
            'type' => ['nullable', 'max:255', 'string'],
            'contact' => ['nullable', 'max:255', 'string'],
            'source' => ['nullable', 'max:255', 'string'],
            'region' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
            'potential_opportunity' => ['nullable', 'numeric'],
            'chance_of_sale' => ['nullable', 'numeric'],
            'forecast_close' => ['nullable', 'max:255', 'string'],
            'weighted_forecast' => ['nullable', 'numeric'],
        ];
    }
}

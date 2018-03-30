<?php

namespace App\Http\Requests\Labor;

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
            'catalog_id' => 'required',
            'price'      => 'required',
            'date'       => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'catalog_id.required' => 'Το πεδίο ΑΝΤΙΚΕΙΜΕΝΟ είναι απαραίτητο.',
            'price.required'      => 'Το πεδίο ΤΙΜΗ είναι απαραίτητο.',
            'date.required'       => 'Το πεδίο ΗΜΕΡΟΜΗΝΙΑ είναι απαραίτητο.',
        ];
    }
}

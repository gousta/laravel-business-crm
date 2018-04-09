<?php

namespace App\Http\Requests\Vat;

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
            'date' => 'required',
            'cashier' => 'required',
            'invoice' => 'required',
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
            'date.required' => 'Το πεδίο ΜΗΝΑΣ είναι απαραίτητο.',
            'cashier.required' => 'Το πεδίο ΦΠΑ ΤΑΜΕΙΑΚΗΣ είναι απαραίτητο.',
            'invoice.required' => 'Το πεδίο ΦΠΑ ΑΠΟ ΤΙΜΟΛΟΓΙΑ είναι απαραίτητο.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            //regex:/^[\pL\s\-]+$/u', regla para solo letas y espacios
            'name' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'kind_of_society' => 'required|max:128',
            'nit' => 'required|unique:providers|digits:9|numeric',
            'country' => 'required|max:128',
            'city' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
            'address' => 'required|max:128',
            'url' => 'required|url|unique:providers|max:128',
            'sales_representative' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'email_contact' => 'required|email|unique:providers|max:128',
            'phone_contact' => 'required |unique:providers|digits:7|numeric',
            'extension_contact' => 'required|unique:providers|digits_between:3,10|numeric',
            'billing_period' => 'required|string|max:128',
            'payment_type' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'company_id' => 'required|numeric',
            'creation_date' => 'required|date',
            'user_id' => 'required|numeric',

        ];
    }
}

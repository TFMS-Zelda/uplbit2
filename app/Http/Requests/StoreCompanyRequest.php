<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
           'name' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
           'kind_of_society' => 'required|max:128',
           'nit' => 'required |unique:companies|digits:9|numeric',
           'country' => 'required|max:128',
           'city' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
           'address' => 'required|unique:companies|max:128',
           'url' => 'required|unique:companies|max:128',
           //regex:/^[\pL\s\-]+$/u', regla para solo letas y espacios
           'person_contact' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
           'email_contact' => 'required |email|unique:companies|max:128',
           'phone_contact' => 'required|digits:7|numeric|unique:companies',
           'extension_contact' => 'required|digits_between:3,10|numeric',
           'creation_date' => 'required|date',
           'user_id' => 'required|numeric',
        ];
    }
}



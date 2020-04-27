<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'nit' => "required|digits:9|numeric|unique:companies,nit,{$this->company->id}",
            'country' => 'required|max:128',
            'city' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
            'address' => "required|max:128|unique:companies,address,{$this->company->id}",
            'url' => "required|max:128|unique:companies,url,{$this->company->id}",
            //regex:/^[\pL\s\-]+$/u', regla para solo letras y espacios
            'person_contact' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
            'email_contact' => "required|email|max:128|unique:companies,email_contact,{$this->company->id}",
            'phone_contact' => "required|digits:7|numeric|unique:companies,phone_contact,{$this->company->id}",
            'extension_contact' => 'required|digits_between:3,10|numeric',
            'creation_date' => 'required|date',
            'user_id' => 'required|numeric',
        ];
    }
}

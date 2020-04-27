<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
            'nit' => "required|digits:9|numeric|unique:providers,nit,{$this->provider->id}",
            'country' => 'required|max:128',
            'city' => 'required|max:128|regex:/^[\pL\s\-]+$/u',
            'address' => 'required|max:128',
            'url' => "required|max:128|unique:providers,url,{$this->provider->id}",
            'sales_representative' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'email_contact' => "required|email|max:128|unique:companies,email_contact,{$this->provider->id}",
            'phone_contact' => "required|digits:7|numeric|unique:companies,phone_contact,{$this->provider->id}",
            'extension_contact' => 'required|digits_between:3,10|numeric',
            'billing_period' => 'required|string|max:128',
            'payment_type' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'company_id' => 'required|numeric',
            'creation_date' => 'required|date',
            'user_id' => 'required|numeric',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOtherPeripheralsRequest extends FormRequest
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
            
        'type_device' => 'required|string|max:128|',
        'type_other_peripherals' => 'required|string|max:128|',
        'brand' => 'required|string|max:64|',
        'model' => 'required|string|max:64|',
        'serial' => "required|max:64|unique:other_peripherals,serial,{$this->otherPeripheral->id}",
        'license_plate' => "required|digits_between:7,7|unique:other_peripherals,license_plate,{$this->otherPeripheral->id}",
        'location' => 'required|max:128',
        'status' => 'required|max:128',
        'warranty_start' => 'required|date|before:warranty_end',
        'warranty_end' => 'required|date|after:warranty_start',
        'description_of_characteristics' => 'required|min:4|max:1024',
        'article_id' => 'required|numeric',
        'user_id' => 'required|numeric',

        ];
    }
}

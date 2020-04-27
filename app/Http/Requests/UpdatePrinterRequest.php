<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrinterRequest extends FormRequest
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

            'brand' => 'required|max:128',
            'serial' => "required|max:64|unique:printers,serial,{$this->printer->id}",
            'printer_functions' => 'required|max:128',
            'resolution' => 'required|max:128',
            'cpu' => 'required|max:128',
            'memory' => 'required|max:128|',
            'hard_disk' => 'required|max:128',
            'paper_sources' => 'required|max:128',
            'input_capacity' => 'required|max:128',
            'output_capacity' => 'required|max:128',
            'license_plate' => "required|max:64|unique:printers,license_plate,{$this->printer->id}",
            'location' => 'required|max:128',
            'mac_adrress' => "required|unique:printers,mac_adrress,{$this->printer->id}",
            'ip_address' => "required|ipv4|unique:printers,ip_address,{$this->printer->id}",
            'input_capacity' => 'required|max:128',
            'output_capacity' => 'required|max:128',
            'warranty_start' => 'required|date|before:warranty_end',
            'warranty_end' => 'required|date|after:warranty_start',
            'user_id' => 'required|numeric',
            'article_id' => 'required|numeric',
        ];
    }
}

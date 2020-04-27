<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenancePrinterRequest extends FormRequest
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
            
            'maintenance_date' => 'required|date',
            'maintenance_type' => 'required|max:128',
            'maintenance_description' => 'required|min:3|max:512',
            'responsible_maintenance' => 'required|max:128',
            'observations' => 'required|min:3|max:512',
            'attachments' => "max:1024|mimes:pdf|nullable|unique:maintenance_printers,attachments,{$this->historyMaintenance->id}",
            'user_id' => 'required|numeric',
            'printer_id' => 'required|numeric',
        ];
    }
}

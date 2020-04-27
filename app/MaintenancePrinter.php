<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenancePrinter extends Model
{
    //code..
    protected $fillable = [
        'maintenance_date', 'maintenance_type', 'maintenance_description', 'responsible_maintenance', 'observations', 'attachments', 'user_id', 'printer_id', 
    ];

    public function printer()
    {
        return $this->belongsTo('App\Printer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

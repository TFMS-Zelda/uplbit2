<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceOtherPeripheral extends Model
{
    
    //code..
    protected $fillable = [
        'maintenance_date', 'maintenance_type', 'maintenance_description', 'responsible_maintenance', 'observations', 'attachments', 'user_id', 'other_peripherals_id', 
    ];

    public function otherPeripheral()
    {
        return $this->belongsTo('App\OtherPeripheral', 'other_peripherals_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

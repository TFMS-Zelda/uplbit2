<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceComputer extends Model
{
    protected $fillable = [
        'maintenance_date', 'maintenance_type', 'maintenance_description', 'responsible_maintenance', 'observations', 'attachments', 'user_id', 'computer_id',
    ];

    public function computer()
    {
        return $this->belongsTo('App\Computer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Computer extends Model
{
    use SoftDeletes;
    //asignacion masiva
    protected $fillable = [
        'type_machine', 'brand', 'model', 'servicetag', 'servicecode', 'operating_system', 'hard_drive', 'processor',  'memory_ram', 'charger_model', 'charger_serial',
        'hostname', 'workgroup', 'domain_name', 'license', 'license_plate', 'article_id', 'status', 'warranty_start', 'warranty_end',  'user_id',
    ];

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }

    /**
     * Get the article record associated with the computer.
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'id', 'article_id');
    }

    /**
     * Get the article record associated with the computer.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

  

    
}


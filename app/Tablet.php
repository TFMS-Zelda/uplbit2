<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tablet extends Model
{
    //code..
    use SoftDeletes;
    protected $fillable = ['brand', 'model', 'color', 'serial', 'screen', 'processor', 'memory', 'camera', 'battery', 
    'operating_system', 'optical_pencil', 'charger_model',
    'charger_serial', 'data_plan', 'sim_card', 'pin', 'imei', 'phone_number', 'license_plate',
    'location', 'status', 'warranty_start', 'warranty_end', 'article_id', 'user_id'
];

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

    public function assignments()
    {
        return $this->morphMany(RelationshipConfiguration::class, 'assignable');
    }


}

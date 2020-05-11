<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Monitor extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'brand', 'model', 'serial', 'screen_type', 'screen_format', 'backlight', 'input_connector_type', 'maximum_resolution',  'power_supply', 'charger_serial',
        'license_plate', 'article_id', 'location', 'status', 'warranty_start', 'warranty_end',  'user_id',
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

    public function assignments()
    {
        return $this->morphMany(RelationshipConfiguration::class, 'assignable');
    }

}

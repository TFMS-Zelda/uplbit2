<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationshipConfiguration extends Model
{
    protected $fillable = [];

    public function assignable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function computer()
    {
        return $this->belongsTo('App\Computer');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function tablet()
    {
        return $this->belongsTo('App\Tablet');
    }

    public function assignments()
    {
        return $this->morphMany(RelationshipConfiguration::class, 'assignable');
    }

}

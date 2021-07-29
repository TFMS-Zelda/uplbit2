<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [];

    public function commentable()
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

    public function printer()
    {
        return $this->belongsTo('App\Printer');
    }

    public function tablet()
    {
        return $this->belongsTo('App\Tablet');
    }

    public function skms()
    {
        return $this->belongsTo('App\Skms');
    }

}

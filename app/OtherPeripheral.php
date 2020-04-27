<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OtherPeripheral extends Model
{
    use SoftDeletes;
     
    protected $fillable = [
        'type_device', 
        
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

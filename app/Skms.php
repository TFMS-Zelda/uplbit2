<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skms extends Model
{
    protected $fillable = [
        'classification_file', 'category_file', 'name_file', 'creation_date', 'impact_level',
        'user_id', 'code_file', 'digital_file',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

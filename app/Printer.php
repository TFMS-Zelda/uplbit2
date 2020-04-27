<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Printer extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand', 'model', 'serial', 'printer_functions', 'resolution', 'cpu', 'memory', 'hard_disk', 'paper_sources', 'input_capacity', 'output_capacity',
        'license_plate', 'location', 'mac_adrress', 'ip_address', 'status', 'warranty_start', 'warranty_end', 'article_id', 'user_id'
    ];
    


     /**
     * Get the article record associated with the Printer.
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'id', 'article_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

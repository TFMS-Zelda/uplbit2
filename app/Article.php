<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = [
    'user_id', 'provider_id', 'area', 'invoice_date', 'expiration_date',
    'remission', 'quotation', 'quantity', 'unit_value',
    'total_value', 'total_bill', 'total_in_letters', 'invoice_number', 'seller',
    'digital_invoice', 'observations',
    ];

    /**
     * Get the provider that owns the articles.
     */
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    /**
     * Get the computer that owns the article.
     */
    public function computer()
    {
        return $this->belongsTo('App\Computer');
    }

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the monitor that owns the article.
     */
    public function monitor()
    {
        return $this->belongsTo('App\Monitor');
    }


    /**
     * Get the printer that owns the article.
     */
    public function printer()
    {
        return $this->belongsTo('App\Printer');
    }

}

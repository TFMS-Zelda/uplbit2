<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Provider extends Model
{
     protected $fillable = ['name', 'kind_of_society', 'nit', 'country', 'city', 'address', 'url', 'sales_representative', 'email_contact', 'phone_contact',
        'extension_contact', 'billing_period', 'payment_type', 'creation_date', 'company_id', 'user_id'
    ];

    /**
     * Get the articles for the Provider.
     */
    public function Articles()
    {
        return $this->hasMany('App\Article');
    }
}



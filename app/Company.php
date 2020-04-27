<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Company extends Model
{
    protected $fillable = [
        'name', 'kind_of_society', 'nit', 'country', 'city', 'address', 'url', 'person_contact', 'email_contact', 'phone_contact',
        'extension_contact', 'creation_date', 'user_id',
    ];
}

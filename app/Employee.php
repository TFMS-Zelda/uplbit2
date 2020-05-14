<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
  // Employee usara borrado suave logico
  use SoftDeletes;
  protected $fillable = ['name', 'email_corporate', 'job_title', 'employee_type', 'ugdn',
  'status', 'work_area', 'country', 'city', 'phone', 'profile_avatar', 'creation_date', 'citizenship_card', 'company_id', 'user_id'
];

 public function assignments()
    {
        return $this->morphMany(RelationshipConfiguration::class, 'assignable');
    }

}

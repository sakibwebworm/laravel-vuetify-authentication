<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotentialCustomer extends Model
{
    protected $fillable = [
        'email','name'
    ];
}

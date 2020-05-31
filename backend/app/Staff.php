<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city', 'industry'
    ];

}

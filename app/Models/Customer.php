<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as CustomerAuthenticate;

class Customer extends CustomerAuthenticate
{
    protected $guarded=[];
}

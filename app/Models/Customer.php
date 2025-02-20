<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;


class Customer extends Model
{
    use \Illuminate\Auth\Authenticatable;
    
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'contactNumber',
        'password',
    ];
}

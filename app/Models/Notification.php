<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'message',
        'user_id',
    ];
}

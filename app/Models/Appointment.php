<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'serviceID',
        'customerName',
        'contactNumber',
        'appointmentDate',
        'appointmentTime',
        'userID',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'serviceID');
    }
}

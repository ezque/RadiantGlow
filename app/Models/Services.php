<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';  

    protected $fillable = [
        'serviceName',
        'categoryID',
        'price',
        'image'
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'serviceID');
    }

}

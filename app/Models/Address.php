<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip_code',
        'street',
        'number',
        'complement',
        'district',
        'city_id',
        'user_id'
    ];

    public function city() 
    {
        return $this->belongsTo(City::class);
    }

    public function user() 
    {
        return $this->hasOne(User::class);
    }
}


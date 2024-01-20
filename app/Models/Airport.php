<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'address',
        'number',
        'zip_code',
        'complement',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

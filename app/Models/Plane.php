<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = ['qtd_passengers', 'class', 'brand_id'];

    public function classes_planes()
    {
        return [
            'economic' => 'Econômica',
            'luxury' => 'Luxo'
        ];
    }

}

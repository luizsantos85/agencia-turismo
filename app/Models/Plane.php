<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = ['qtd_passengers', 'class', 'brand_id'];

    public function classes_planes($className = null)
    {
        $classes =  [
            'economic' => 'Econômica',
            'luxury' => 'Luxo'
        ];

        if (!$className) {
            return $classes;
        }
        
        return $classes[$className];
    }

    //Relacionamentos
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

}

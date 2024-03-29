<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function airports()
    {
        return $this->hasMany(Airport::class, 'city_id', 'id');
    }

    public function search($data, $totalPage = null)
    {
        return $this->where('name', 'like', "%{$data}%")
            ->get();
    }
}

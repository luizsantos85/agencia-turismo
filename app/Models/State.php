<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function search($data, $totalPage = null)
    {
        return $this->where('name', 'like', "%{$data}%")
            ->orWhere('initials', $data)
            ->get();
    }

    public function cities()
    {
        return $this->hasMany(City::class,'state_id');
    }

    public function citiesSearch($cityName, $totalPage = null)
    {
        return $this->cities()
            ->where('name', 'like', "%{$cityName}%")
            ->paginate($totalPage);
    }

}

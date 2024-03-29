<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function search($data, $totalPage)
    {
        // $dataSearch = $data->name;
        return $this->where('name','like',"%{$data}%")->paginate($totalPage);
    }


    //Relacionamentos
    public function planes()
    {
        return $this->hasMany(Plane::class,'brand_id');
    }
}

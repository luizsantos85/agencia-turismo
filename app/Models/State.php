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
}

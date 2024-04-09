<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['date_reserved','status','user_id','flight_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    /**
     * Funções
     *
     * @return array
     */
    public function status($option = null)
    {
        $statusAvialable = [
            'reserved' => 'Reservado',
            'canceled' => 'Cancelado',
            'paid' => 'Pago',
            'conclued' => 'Concluído',
        ];

        if($option){
            return $statusAvialable[$option];
        }

        return $statusAvialable;
    }

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        return $this->save();
    }

    // public function search($data, $totalPage)
    // {
    //     return $this->where('name', 'like', "%{$data}%")->paginate($totalPage);
    // }
}

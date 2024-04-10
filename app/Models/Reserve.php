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

    public function search($data, $totalPage)
    {
        $reserves = $this->when(isset($data['name_user']) && $data['name_user'] != null, function ($query) use ($data) {
            //Buscar usuario pelo nome com relacionamento user
            $query->whereHas('user', function($subQuery) use ($data){
                $subQuery->where('name','like', '%'. $data['name_user'] . '%');
            });
        })
        ->when(isset($data['date_flight']) && $data['date_flight'] != null, function ($query) use ($data) {
            //Buscar voo pela data com relacionamento flight
            $query->whereHas('flight', function($subQuery) use ($data){
                $subQuery->whereDate('date', $data['date_flight']);
            });
        })
        ->when(isset($data['id_voo']) && $data['id_voo'] != null, function ($query) use ($data) {
            $query->where('flight_id', $data['id_voo']);
        })
        ->when(isset($data['status']) && $data['status'] != null, function ($query) use ($data) {
            $query->where('status', $data['status']);
        })
        ->paginate($totalPage);

        return $reserves;
    }
}

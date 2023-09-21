<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'time_duration',
        'hour_output',
        'arrival_time',
        'old_price',
        'price',
        'total_plots',
        'is_promotion',
        'image',
        'qtd_stops',
        'description',
        'plane_id',
        'airport_origin_id',
        'airport_destination_id',
    ];



    public function createFlight($request)
    {
        $data = [
            'date' => $request['date'],
            'time_duration' => $request['time_duration'],
            'hour_output' => $request['hour_output'],
            'arrival_time' => $request['arrival_time'],
            'old_price' => $request['old_price'],
            'price' => $request['price'],
            'total_plots' => $request['total_plots'],
            'is_promotion' => isset($request['is_promotion']) ? 1 : 0,
            'image' => isset($request['image']) ? $request['image'] : null,
            'qtd_stops' => $request['qtd_stops'],
            'description' => $request['description'],
            'plane_id' => $request['plane_id'],
            'airport_origin_id' => $request['airport_origin'],
            'airport_destination_id' => $request['airport_destination'],
        ];

        return $this->create($data);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class navettes extends Model
{
    /** @use HasFactory<\Database\Factories\NavettesFactory> */
    use HasFactory;

    protected $fillable = [
        'campany_id',
        'nom',
        'description',
        "type_vehicule",
        "places_disponible",
        "city_start",
        "city_arrive",
        "time_start",
        "time_end",
    ];

    public function company()
    {
        return $this->belongsTo(campanys::class);
    }

    public function cityStart()
    {
        return $this->belongsTo(citys::class, 'city_start');
    }

    public function cityArrive()
    {
        return $this->belongsTo(citys::class, 'city_arrive');
    }
}

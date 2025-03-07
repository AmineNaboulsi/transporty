<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class navettes extends Model
{
    /** @use HasFactory<\Database\Factories\NavettesFactory> */
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'navette_tags', 'navette_id', 'tag_id');
    }
    protected $fillable = [
        'campany_id',
        'nom',
        'price',
        'description',
        "type_vehicule",
        "date_navette",
        "places_disponible",
        "city_start",
        "city_arrive",
        "time_start",
        "time_end",
        "time_end"
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citys extends Model
{
    /** @use HasFactory<\Database\Factories\CitysFactory> */
    use HasFactory;

    public function departures()
    {
        return $this->hasMany(navettes::class, 'city_start');
    }

    public function arrivals()
    {
        return $this->hasMany(navettes::class, 'city_arrive');
    }

}

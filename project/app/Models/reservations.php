<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservations extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationsFactory> */
    use HasFactory;

    protected $fillable = ['navette_id', 'user_id', 'status'];
    public function navette()
    {
        return $this->belongsTo(Navettes::class, 'navette_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

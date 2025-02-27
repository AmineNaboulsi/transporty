<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campanys extends Model
{
    /** @use HasFactory<\Database\Factories\CampanysFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'logo',
        "adresse",
        "telephone",
    ];
    public function navettes()
    {
        return $this->hasMany(navettes::class, 'campany_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

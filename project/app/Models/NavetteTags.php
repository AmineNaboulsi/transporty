<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavetteTags extends Model
{
    //
    protected $fillable = [
        'navette_id',
        'tag_id',
    ];
    public function navette()
    {
        return $this->belongsTo(navettes::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuntungan extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}

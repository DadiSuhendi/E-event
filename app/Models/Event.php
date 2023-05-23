<?php

namespace App\Models;

use App\Models\Keuntungan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function keuntungans()
    {
        return $this->belongsToMany(Keuntungan::class);
    }

    public function pemateris()
    {
        return $this->belongsToMany(Pemateri::class);
    }
}

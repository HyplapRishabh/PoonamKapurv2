<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartaddon extends Model
{
    use HasFactory;

    public function addon()
    {
        return $this->hasOne(Addon::class, 'id' , 'addonId');
    }
}

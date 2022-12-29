<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventoryhistory extends Model
{
    use HasFactory;

    public function rawmaterial()
    {
        return $this->hasOne(Rawmaterial::class, 'UID', 'item');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'UID', 'forProduct');
    }
}

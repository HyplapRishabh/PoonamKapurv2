<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'quantity',
        'unit',
        'alaCartFlag',
        'status',
        'mealTypeId',
    ];

    public function mealtype()
    {
        return $this->hasOne(Mealtype::class, 'id', 'mealTypeId');
    }
}

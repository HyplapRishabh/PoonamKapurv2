<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alacartorder extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'trxId',
        'productId',
        'productName',
        'productImg',
        'qty',
        'addonName',
        'productPrice',
        'addonprice'
    ];
}
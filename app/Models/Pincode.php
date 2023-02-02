<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;

    protected $table = 'pincodes';

    protected $fillable = [
        'pincode',
        'areaName',
        'breakFastFlag',
        'lunchFlag',
        'snackFlag',
        'dinnerFlag',
        'alaCartFlag',
        'deliveryCharge',
        'status',
    ];
}

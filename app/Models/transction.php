<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'invoiceno',
        'trxdate',
        'subtotalamt',
        'discountamt',
        'gstamt',
        'deliveryamt',
        'finalamt',
        'paymenId',
        'trxFor',
        'userId',
        'address',
        'landmark',
        'pincode',
        'area',
        'city',
        'trxStatus',
        'cpname',
        'cpno','deliverystatus'
    ];

    public function trxalacartorder()
    {
        return $this->hasMany(alacartorder::class, 'trxId', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function trxsubscriptionorder()
    {
        return $this->hasOne(subscriptionorder::class, 'trxId', 'id');
    }
    
}

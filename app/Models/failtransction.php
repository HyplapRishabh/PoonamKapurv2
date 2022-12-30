<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class failtransction extends Model
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
        'cpno','deliverystatus','mode',
        'payutxnid',
        'reason',
        'errormsg',
    ];

    public function trxalacartorder()
    {
        return $this->hasMany(failalacartorder::class, 'trxId', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function trxsubscriptionorder()
    {
        return $this->hasOne(failsubscriptionorder::class, 'trxId', 'id');
    }
    
}

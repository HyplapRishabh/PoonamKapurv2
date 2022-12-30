<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class failsubscriptionorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'trxId','userId','packageId','totaldays','totalmeal',
        'subscribedfor','startdate','status','mealPrice'
    ];

    public function pkgdtl()
    {
        return $this->hasOne(Package::class, 'UID', 'packageId');
    }
}

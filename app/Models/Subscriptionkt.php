<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptionkt extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function subscription()
    {
        return $this->hasOne(subscriptionorder::class, 'id', 'subOdrId');
    }

    public function trx()
    {
        return $this->hasOne(transction::class, 'id', 'trxId');
    }
}

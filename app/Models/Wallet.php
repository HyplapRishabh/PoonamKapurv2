<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'userId',
        'availableBal',
        'lockedAmt',
        'totalAdded',
        'totalSpent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function walletremarks()
    {
        return $this->hasMany(Walletremark::class, 'userId' , 'userId');
    }
}

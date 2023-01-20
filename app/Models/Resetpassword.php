<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resetpassword extends Model
{
    use HasFactory;

    protected $table = 'resetpasswords';

    protected $fillable = [
        'userId','token'
    ];
}

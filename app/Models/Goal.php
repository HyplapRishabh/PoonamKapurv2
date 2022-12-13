<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public function package()
    {
        return $this->hasOne(Package::class, 'goalId' , 'id')->where([['deleteId', '0'],['status','1']])->with('mealtype');
    }
}

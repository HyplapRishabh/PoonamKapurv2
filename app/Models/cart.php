<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function product()
    {
        return $this->hasOne(Product::class, 'id' , 'productId')->where([['deleteId', '0'],['status','1']])
        ->select('deleteId','status','id','image','name','discountedPrice','slug','mealTypeId');
    }

    public function addoncart()
    {
        return $this->hasOne(cartaddon::class, 'cartId' , 'id')->with('addon');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packagemenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'packageUId',
        'day',
        'breakFast',
        'lunch',
        'snack',
        'dinner',
    ];

    public function package()
    {
        return $this->hasOne(Package::class, 'UID', 'packageUId');
    }

    public function bf(){
        return $this->hasOne(Product::class, 'UID', 'breakFast');
    }

    public function l(){
        return $this->hasOne(Product::class, 'UID', 'lunch');
    }

    public function s(){
        return $this->hasOne(Product::class, 'UID', 'snack');
    }

    public function d(){
        return $this->hasOne(Product::class, 'UID', 'dinner');
    }

    public function webbreakfast(){
        return $this->hasOne(Product::class, 'UID', 'breakFast')->where([['deleteId', '0'],['status','1']])
        ->select('deleteId','status','id','image','name','slug','UID')->with('macro');
    }

    public function weblunch(){
        return $this->hasOne(Product::class, 'UID', 'lunch')->where([['deleteId', '0'],['status','1']])
        ->select('deleteId','status','id','image','name','slug','UID')->with('macro');
    }

    public function websnacks(){
        return $this->hasOne(Product::class, 'UID', 'snack')->where([['deleteId', '0'],['status','1']])
        ->select('deleteId','status','id','image','name','slug','UID')->with('macro');
    }

    public function webdinner(){
        return $this->hasOne(Product::class, 'UID', 'dinner')->where([['deleteId', '0'],['status','1']])
        ->select('deleteId','status','id','image','name','slug','UID')->with('macro');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function createWalletUser($userId)
    {
        $wallet = new Wallet();
        $wallet->userId = $userId;
        $wallet->availableBal = 0;
        $wallet->lockedAmt = 0;
        $wallet->totalAdded = 0;
        $wallet->totalSpent = 0;
        $wallet->save();
    } 
}

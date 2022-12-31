<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Walletremark;
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

    public function lockamount($userId, $amount, $lockedAmount, $trxId, $trxFor, $remark)
    {
        $wallet = Wallet::where('userId', $userId)->first();
        $wallet->availableBal -= $amount;
        $wallet->lockedAmt += $lockedAmount;
        $spentTotal = 0;
        $wallet->totalSpent += $spentTotal;
        $wallet->update();

        $walletRemark = new Walletremark();
        $walletRemark->userId = $userId;
        $walletRemark->trxType = 'Debit';
        $walletRemark->trxId = $trxId;
        $walletRemark->trxFor = $trxFor;
        $walletRemark->amount = $spentTotal;
        $walletRemark->remark = $remark;
        $walletRemark->save();
    }

    public function debitAmount($userId, $amount, $lockedAmount , $trxId, $trxFor, $remark)
    {
        $wallet = Wallet::where('userId', $userId)->first();
        $wallet->availableBal -= $amount;
        $wallet->lockedAmt -= $lockedAmount;
        $spentTotal = $amount + $lockedAmount;
        $wallet->totalSpent += $spentTotal;
        $wallet->update();

        $walletRemark = new Walletremark();
        $walletRemark->userId = $userId;
        $walletRemark->trxType = 'Debit';
        $walletRemark->trxId = $trxId;
        $walletRemark->trxFor = $trxFor;
        $walletRemark->amount = $spentTotal;
        $walletRemark->remark = $remark;
        $walletRemark->save();
    }

    public function creditAmount($userId, $amount, $lockedAmount, $trxId, $trxFor, $remark)
    {
        $wallet = Wallet::where('userId', $userId)->first();
        $wallet->availableBal += $amount;
        $wallet->lockedAmt += $lockedAmount;
        $addedTotal = $amount + $lockedAmount;
        $wallet->totalAdded += $addedTotal;
        $wallet->update();

        $walletRemark = new Walletremark();
        $walletRemark->userId = $userId;
        $walletRemark->trxType = 'Credit';
        $walletRemark->trxId = $trxId;
        $walletRemark->trxFor = $trxFor;
        $walletRemark->amount = $addedTotal;
        $walletRemark->remark = $remark;
        $walletRemark->save();
    }
}

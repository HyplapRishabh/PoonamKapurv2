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

    public function sendotp($userNumber,$otp)
    {
        // Account details
        $apiKey = urlencode('NWEzMTU0NDc3YTUzMzgzMDQ4NTA2Yjc3NzA2ODY1Mzk=');
            
        // Message details
        $numbers = urlencode($userNumber);
        $sender = urlencode('PKAPUR');
        $message = rawurlencode('Dear User, '.$otp.' is the OTP to Register on the portal www.poonamkapur.com. Thank you, Team Grishma Health Foods Pvt. Ltd.');
    
        // Prepare data for POST request
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
        // return $data;
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully',
            'data' => $response
        ]);

        curl_close($ch); 
    }

    
    
    public function sendloginotp($userNumber,$otp)
    {
        // Account details
        $apiKey = urlencode('NWEzMTU0NDc3YTUzMzgzMDQ4NTA2Yjc3NzA2ODY1Mzk=');
            
        // Message details
        $numbers = urlencode($userNumber);
        $sender = urlencode('PKAPUR');
        $message = rawurlencode('Dear User, '.$otp.' is your OTP to log in to the portal www.poonamkapur.com. Thank you, Team Grishma Health Foods Pvt. Ltd.');
    
        // Prepare data for POST request
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
        // return $data;
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch); 
    }

    public function orderConfirmationMsg($userNumber,$orderId)
    {
        // Account details
        $apiKey = urlencode('NWEzMTU0NDc3YTUzMzgzMDQ4NTA2Yjc3NzA2ODY1Mzk=');
            
        // Message details
        $numbers = urlencode($userNumber);
        $sender = urlencode('PKAPUR');
        $message = rawurlencode('Thanks for your order with PKAPUR Healthy kitchen(PKHK). Your order id is '.$orderId);
    
        // Prepare data for POST request
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
        // return $data;
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch); 

    }

    public function subscriptionConfirmationMsg($userNumber, $packageName, $days ,$orderId)
    {
        // Account details
        $apiKey = urlencode('NWEzMTU0NDc3YTUzMzgzMDQ4NTA2Yjc3NzA2ODY1Mzk=');
            
        // Message details
        $numbers = urlencode($userNumber);
        $sender = urlencode('PKAPUR');
        $message = rawurlencode('Dear User, Your Subscription of '.$packageName.' is successful for '.$days.' days. Your Order Id is '.$orderId.'. Thank You, Team Grishma Health Foods Pvt. Ltd');
    
        // Prepare data for POST request
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
        // return $data;
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch); 

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function giftCardManagement()
    {
        return view('admin.gift_card');
    }

    public function walletTransactions()
    {
        return view('admin.wallet_transaction');
    }

    public function redemptionRequests()
    {
        return view('admin.redemption_req');
    }
}
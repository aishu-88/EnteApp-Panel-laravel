<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function allAds()
    {
        return view('admin.all_ads');
    }

    public function create()
    {
        return view('admin.create_ads');
    }

    public function pendingAds()
    {
        return view('admin.pending_ads');
    }

    public function adSlotsManagement()
    {
        return view('admin.ads_slots');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function allOffers()
    {
        return view('admin.all_offer');
    }

    public function create()
    {
        return view('admin.Add_offer');
    }

    public function scheduledOffers()
    {
        return view('admin.scheduled_offer');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function panchayathNotices()
    {
        return view('admin.panchayath_notice');
    }

    public function emergencyContacts()
    {
        return view('admin.emrgncy_contact');
    }

    public function localAnnouncements()
    {
        return view('admin.announcement');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function generalSettings()
    {
        return view('admin.general_setting');
    }

    public function appConfiguration()
    {
        return view('admin.app_config');
    }

    public function localitySetup()
    {
        return view('admin.locality_setup');
    }

    public function notificationSettings()
    {
        return view('admin.notification');
    }
}
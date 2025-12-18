<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function employees()
    {
        return view('admin.employee');
    }

    public function rolesPermissions()
    {
        return view('admin.permission');
    }

    public function activityLogs()
    {
        return view('admin.activity-logs');
    }
}
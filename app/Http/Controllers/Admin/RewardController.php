<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function dailyChallenges()
    {
        return view('admin.daily_challenge');
    }

    public function spinWin()
    {
        return view('admin.spin_win');
    }

    public function scratchCards()
    {
        return view('admin.scratch_card');
    }

    public function rewardRules()
    {
        return view('admin.reward');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('admin.plan', compact('plans'));
    }

    public function create()
    {
        return view('admin.plan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect()
            ->route('admin.admin.plan')
            ->with('success', 'Plan created successfully');
    }
}

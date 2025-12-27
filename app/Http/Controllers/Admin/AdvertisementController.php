<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    // List all ads
    public function allAds()
{
    $ads = Advertisement::latest()->get(); // fetch from DB
    return view('admin.all_ads', compact('ads'));
}

    // Show create form
    public function create()
    {
        return view('admin.create_ads');
    }

    // Store new ad
    public function store(Request $request)
    {
        $request->validate([
            'adTitle'    => 'required|string|max:255',
            'startDate'  => 'required|date',
            'endDate'    => 'required|date|after_or_equal:startDate',
            'adStatus'   => 'required|in:active,inactive',
            'targetUrl'  => 'nullable|url',
            'adImage'    => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:10240',
        ]);

        $imagePath = null;

        if ($request->hasFile('adImage')) {
            $imagePath = $request->file('adImage')->store('ads', 'public');
        }

        Advertisement::create([
            'title'      => $request->adTitle,
            'start_date' => $request->startDate,
            'end_date'   => $request->endDate,
            'status'     => $request->adStatus,
            'target_url' => $request->targetUrl,
            'media'      => $imagePath,
        ]);

       return redirect()->route('admin.all-ads')->with('success', 'Advertisement created successfully.');

    }
}

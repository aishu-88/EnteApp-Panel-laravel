<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Listing;
use App\Models\Offer;
use App\Models\Advertisement;
use App\Models\Plan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            // Users
            'totalUsers' => User::count(),

            // Service Providers (example: role based)
            'serviceProviders' => Vendor::where('verification_status', 'approved')->count(),

            // Shop Owners
            'shopOwners' => Vendor::where('main_category_id', '2')->count(),

            // Listings
            'totalListings' => User::where('user_type', 'service_provider')->count(),

            // Pending approvals
            'pendingApprovals' => Vendor::where('verification_status', 'pending')->count(),

            // Active ads
            'activeAds' => Advertisement::where('status', 'active')->count(),

            // Active offers
            'activeOffers' => Offer::where('status', 'active')->count(),

            // Rewards (example)
             'totalPlans' => Plan::count(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}

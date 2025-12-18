<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
   public function allListings(Request $request)
    {
        // Query active listings with optional search and pagination
        $listings = Listing::query()
            ->where('status', 'active') // Filter for active listings
            ->when($request->get('search'), function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%")
                             ->orWhere('provider_name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12); // Paginate for the grid (12 items per page)

        // Pass $listings to the view
        return view('admin.all_list', compact('listings'));
    }

   public function pendingApprovals(Request $request)
{
    $listings = Listing::query()
        ->where('status', 'pending')
        ->when($request->search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('provider_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    return view('admin.pending_approval', compact('listings'));
}

public function approve($id)
{
    $listing = Listing::findOrFail($id);
    $listing->update(['status' => 'active']);
    return back()->with('success', 'Listing approved successfully.');
}

public function reject($id)
{
    $listing = Listing::findOrFail($id);
    $listing->update(['status' => 'rejected']); // Or 'inactive'; adjust as needed
    return back()->with('success', 'Listing rejected.');
}

    public function featuredListings(Request $request)
{
    $listings = Listing::query()
        ->where('featured', true) // Filter for featured listings
        ->when($request->search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('provider_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    return view('admin.featured_list', compact('listings'));
}

    public function categories()
    {
        return view('admin.categories');
    }
    public function deactivate($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['status' => 'inactive']);
        return back()->with('success', 'Listing deactivated successfully.');
    }
}
<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Show add vendor form
     */
    public function create()
    {
        return view('provider.add_vendor');
    }

    /**
     * Store vendor (Pending approval)
     */
    public function store(Request $request)
    {
        $request->validate([
            'shop_name'      => 'required|string|max:255',
            'category'       => 'required|string|max:100',
            'owner_name'     => 'nullable|string|max:255',
            'mobile'         => 'required|string|max:20',
            'whatsapp'       => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
            'panchayath'     => 'nullable|string|max:255',
            'google_map'     => 'nullable|url',
            'opening_time'   => 'nullable',
            'closing_time'   => 'nullable',
            'service_area'   => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'plan_id'        => 'required|integer',
        ]);

        // Main photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('vendors/main', 'public');
        }

        // Gallery images upload
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('vendors/gallery', 'public');
            }
        }

        // Create vendor
        Vendor::create([
            'provider_id'        => Auth::id(),
            'shop_name'          => $request->shop_name,
            'category'           => $request->category,
            'owner_name'         => $request->owner_name,
            'mobile'             => $request->mobile,
            'whatsapp'           => $request->whatsapp,
            'address'            => $request->address,
            'panchayath'         => $request->panchayath,
            'google_map'         => $request->google_map,
            'opening_time'       => $request->opening_time,
            'closing_time'       => $request->closing_time,
            'service_area'       => $request->service_area,
            'description'        => $request->description,
            'photo'              => $photoPath,
            'gallery'            => json_encode($galleryPaths),
            'plan_id'            => $request->plan_id,
            'verification_status'=> 'Pending', // 🔥 Important
        ]);

        return redirect()
            ->route('provider.dashboard')
            ->with('success', 'Vendor added successfully. Waiting for admin approval.');
    }

    public function index(Request $request)
{
    $vendors = Vendor::where('provider_id', auth()->id())
        ->when($request->name, fn($q) =>
            $q->where('shop_name', 'like', '%' . $request->name . '%')
        )
        ->when($request->category, fn($q) =>
            $q->where('category', 'like', '%' . $request->category . '%')
        )
        ->when($request->ward, fn($q) =>
            $q->where('address', 'like', '%' . $request->ward . '%')
        )
        ->when($request->plan_id, fn($q) =>
            $q->where('plan_id', $request->plan_id)
        )
        ->latest()
        ->paginate(10);

    return view('provider.vendor_list', compact('vendors'));
}
public function toggleStatus($id)
{
    $vendor = Vendor::where('provider_id', auth()->id())->findOrFail($id);

    $vendor->is_active = !$vendor->is_active;
    $vendor->save();

    return back()->with('success', 'Vendor status updated');
}
public function edit($id)
{
    $vendor = Vendor::where('provider_id', auth()->id())->findOrFail($id);
    return view('provider.edit_vendor', compact('vendor'));
}


}

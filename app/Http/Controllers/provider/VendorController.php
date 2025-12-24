<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Show add vendor form
     */
    public function create()
    {
        $mainCategories = MainCategory::orderBy('name')->get();

        return view('provider.add_vendor', compact('mainCategories'));
    }

    public function getByMain($mainCategoryId)
    {
        $categories = Category::where('main_category_id', $mainCategoryId)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }



    /**
     * Store vendor (Pending approval)
     */
    public function store(Request $request)
    {
        $request->validate([
            'shop_name'         => 'required|string|max:255',
            'main_category_id'  => 'required|exists:main_categories,id',
            'category_id'       => 'required|exists:categories,id',
            'mobile'            => 'required|string|max:20',
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'plan_id'           => 'required'
        ]);

        $vendor = new Vendor();
        $vendor->provider_id      = Auth::guard('provider')->id();
        $vendor->shop_name        = $request->shop_name;
        $vendor->main_category_id = $request->main_category_id;
        $vendor->category_id      = $request->category_id;
        $vendor->owner_name       = $request->owner_name;
        $vendor->mobile           = $request->mobile;
        $vendor->whatsapp         = $request->whatsapp;
        $vendor->address          = $request->address;
        $vendor->panchayath       = $request->panchayath;
        $vendor->google_map       = $request->google_map;
        $vendor->opening_time     = $request->opening_time;
        $vendor->closing_time     = $request->closing_time;
        $vendor->service_area     = $request->service_area;
        $vendor->description      = $request->description;
        $vendor->plan_id          = $request->plan_id;

        // verification status
        $vendor->is_verified = 0; // pending

        // PHOTO UPLOAD
        if ($request->hasFile('photo')) {
            $vendor->photo = $request->file('photo')->store('vendors', 'public');
        }

        // GALLERY UPLOAD
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $img) {
                $gallery[] = $img->store('vendors/gallery', 'public');
            }
            $vendor->gallery = json_encode($gallery);
        }

        $vendor->save();

        return redirect()
            ->route('provider.vendors.create')
            ->with('success', 'Vendor added successfully (Pending verification)');
    }
    public function index(Request $request)
    {
        $vendors = Vendor::where('provider_id', auth()->id())
            ->when(
                $request->name,
                fn($q) =>
                $q->where('shop_name', 'like', '%' . $request->name . '%')
            )
            ->when(
                $request->category,
                fn($q) =>
                $q->where('category', 'like', '%' . $request->category . '%')
            )
            ->when(
                $request->ward,
                fn($q) =>
                $q->where('address', 'like', '%' . $request->ward . '%')
            )
            ->when(
                $request->plan_id,
                fn($q) =>
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

    public function categoriesByType(Request $request)
    {
        $request->validate([
            'type' => 'required|in:service,shop',
        ]);

        // Find main category (Service / Shop)
        $main = MainCategory::where('slug', $request->type)
            ->where('status', 'active')
            ->first();

        if (!$main) {
            return response()->json([]);
        }

        // Load sub categories
        return response()->json(
            $main->categories()
                ->where('status', 'active')
                ->select('id', 'name')
                ->get()
        );
    }
}

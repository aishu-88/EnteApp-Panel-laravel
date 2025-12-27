<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
        $plans = Plan::orderBy('amount')->get();

        return view('provider.add_vendor', compact('mainCategories', 'plans'));
    }

    public function getByMain($mainCategoryId)
    {
        $categories = Category::where('main_category_id', $mainCategoryId)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    public function showForm()
    {
        return view('auth.provider-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:15|unique:users,phone',
            'email'         => 'nullable|email|max:255|unique:users,email',
            'password'      => 'required|min:6|confirmed',
            'service_type'  => 'required|string|max:255',
            'shop_type'     => 'nullable|string|max:255',
        ]);

        User::create([
            'name'         => $request->name,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'user_type'    => 'provider',   // IMPORTANT
            'status'       => 'pending',    // Admin approval
            'service_type' => $request->service_type,
            'shop_type'    => $request->shop_type,
        ]);

        return redirect()->route('provider.register')
            ->with('success', 'Registration successful! Waiting for admin approval.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id' => 'required|exists:categories,id',
            'mobile' => 'required|string|max:20',
            'plan_id' => 'required|exists:plans,id',

            'payment_mode' => 'required|in:gpay,bank_transfer,cash',
            'transaction_id' => 'nullable|string|max:100|required_if:payment_mode,gpay,bank_transfer',
        ]);

        /* ---------- Upload Photo ---------- */
        $photo = $request->file('photo')
            ? $request->file('photo')->store('vendors/photos', 'public')
            : null;

        /* ---------- Upload Gallery ---------- */
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $img) {
                $gallery[] = $img->store('vendors/gallery', 'public');
            }
        }

        /* ---------- Create Vendor ---------- */
        $vendor = Vendor::create([
            'provider_id' => Auth::id(),
            'shop_name' => $request->shop_name,
            'main_category_id' => $request->main_category_id,
            'category_id' => $request->category_id,
            'owner_name' => $request->owner_name,
            'referral_number' => $request->referral_number,
            'mobile' => $request->mobile,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'google_map' => $request->google_map,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'service_area' => $request->service_area,
            'special_recommendation' => $request->special_recommendation,
            'photo' => $photo,
            'gallery' => $gallery,
            'plan_id' => $request->plan_id,

            // 🔒 Locked until admin approval
            'verification_status' => 'pending',
            'is_active' => false,
        ]);

        /* ---------- Determine Payment Status ---------- */
        $paymentStatus = 'pending';

        if (
            in_array($request->payment_mode, ['gpay', 'bank_transfer']) &&
            !empty($request->transaction_id)
        ) {
            $paymentStatus = 'completed';
        }

        /* ---------- Create Payment ---------- */
        Payment::create([
            'vendor_id' => $vendor->id,
            'mode' => $request->payment_mode,
            'transaction_id' => $request->transaction_id,
            'reference_number' => null, // admin fills later
            'status' => $paymentStatus,
        ]);

        return redirect()
            ->route('provider.add-vendor')
            ->with('success', 'Vendor added successfully. Waiting for admin approval.');
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
    public function edit(Vendor $vendor)
    {
        $mainCategories = MainCategory::orderBy('name')->get();
        $categories = Category::where('main_category_id', $vendor->main_category_id)->get();
        $plans = Plan::all();

        return view('provider.edit_vendor', compact('vendor', 'mainCategories', 'categories', 'plans'));
    }

    // Update Vendor
     public function update(Request $request, Vendor $vendor)
    {
        $this->authorizeVendor($vendor);

        $request->validate([
            'shop_name' => 'required',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id' => 'required|exists:categories,id',
            'mobile' => 'required',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $data = $request->only([
            'shop_name',
            'main_category_id',
            'category_id',
            'owner_name',
            'referral_number',
            'mobile',
            'whatsapp',
            'address',
            'google_map',
            'opening_time',
            'closing_time',
            'service_area',
            'special_recommendation',
            'plan_id',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('vendors/photos', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->gallery as $img) {
                $gallery[] = $img->store('vendors/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $vendor->update($data);

        return back()->with('success', 'Vendor updated successfully.');
    }

    public function toggle(Vendor $vendor)
    {
        if ($vendor->provider_id !== Auth::id()) {
            abort(403);
        }

        if ($vendor->verification_status !== 'approved') {
            return back()->with('error', 'Vendor not approved by admin yet');
        }

        $vendor->is_active = !$vendor->is_active;
        $vendor->save();

        return back()->with('success', 'Vendor status updated');
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

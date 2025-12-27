<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminProviderController extends Controller
{
    /* List Providers */
    public function index()
    {
        $providers = User::where('is_service_provider', true)->latest()->get();
        return view('admin.providers.index', compact('providers'));
    }

    /* Approve Provider */
    public function approve(User $user)
    {
        $user->update([
            'provider_status' => 'approved',
            'status'          => 'active',
        ]);

        return back()->with('success', 'Provider approved successfully');
    }

    /* Reject Provider */
    public function reject(User $user)
    {
        $user->update([
            'provider_status' => 'rejected',
            'status'          => 'blocked',
        ]);

        return back()->with('success', 'Provider rejected');
    }
}

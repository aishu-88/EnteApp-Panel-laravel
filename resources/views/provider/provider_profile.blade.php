@extends('layouts.provider')

@section('title', 'My Profile')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/provider-profile.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">My Profile</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('provider.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <!-- Profile Info -->
    <div class="col-lg-6">
        <div class="card profile-card">
            <div class="card-body">
                <h5 class="card-title mb-4">Contact Details</h5>

                <form method="POST" action="{{ route('provider.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control"
                               value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control"
                               value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile"
                               class="form-control"
                               value="{{ auth()->user()->mobile ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp"
                               class="form-control"
                               value="{{ auth()->user()->whatsapp ?? '' }}">
                    </div>

                    <button class="btn btn-primary">
                        <i class="ri-save-line me-1"></i> Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password -->
    <div class="col-lg-6">
        <div class="card profile-card">
            <div class="card-body">
                <h5 class="card-title mb-4">Change Password</h5>

                <form method="POST" action="{{ route('provider.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control" required>
                    </div>

                    <button class="btn btn-warning">
                        <i class="ri-lock-password-line me-1"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Role & Permissions -->
<div class="row">
    <div class="col-12">
        <div class="card profile-card">
            <div class="card-body">
                <h5 class="card-title mb-3">Role & Permissions</h5>

                <div class="d-flex align-items-center">
                    <div class="role-badge me-3">
                        <i class="ri-shield-user-line"></i>
                    </div>
                    <div>
                        <h6 class="mb-1">{{ auth()->user()->role ?? 'Staff' }}</h6>
                        <p class="text-muted mb-0">
                            You have access to manage vendors, update listings,
                            and submit vendors for admin approval.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')

{{-- Page Title --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboards</a></li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- SUMMARY CARDS ROW 1 --}}
<div class="row">

    {{-- Total Users --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Total Users</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['totalUsers'] }}">
                            {{ $data['totalUsers'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                            <i class="bx bx-user text-primary"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.all-users') }}" class="text-decoration-underline">View All Users</a>
            </div>
        </div>
    </div>

    {{-- Service Providers --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Service Providers</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['serviceProviders'] }}">
                            {{ $data['serviceProviders'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-success-subtle rounded fs-3">
                            <i class="ri-handshake-line text-success"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.service-providers') }}" class="text-decoration-underline">View Providers</a>
            </div>
        </div>
    </div>

    {{-- Shop Owners --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Shop Owners</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['shopOwners'] }}">
                            {{ $data['shopOwners'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-info-subtle rounded fs-3">
                            <i class="bx bx-store text-info"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.shop-owners') }}" class="text-decoration-underline">View Shops</a>
            </div>
        </div>
    </div>

    {{-- Total Listings --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Total Employees</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['totalListings'] }}">
                            {{ $data['totalListings'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-secondary-subtle rounded fs-3">
                            <i class="bx bx-list-ul text-secondary"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.employees') }}" class="text-warning text-decoration-underline">
                    View Employee
                </a>
            </div>
        </div>
    </div>

</div>

{{-- SUMMARY CARDS ROW 2 --}}
<div class="row">

    {{-- Pending Approvals --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Pending Approvals</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['pendingApprovals'] }}">
                            {{ $data['pendingApprovals'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                            <i class="bx bx-time-five text-warning"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.verification-requests') }}" class="text-warning text-decoration-underline">
                    Review Now
                </a>
            </div>
        </div>
    </div>

    {{-- Active Ads --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Active Ads</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['activeAds'] }}">
                            {{ $data['activeAds'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-danger-subtle rounded fs-3">
                            <i class="ri-advertisement-line text-danger"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.all-ads') }}" class="text-decoration-underline">View Ads</a>
            </div>
        </div>
    </div>

    {{-- Active Offers --}}
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <p class="text-uppercase fw-medium text-muted mb-0">Active Offers</p>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold">
                        <span class="counter-value" data-target="{{ $data['activeOffers'] }}">
                            {{ $data['activeOffers'] }}
                        </span>
                    </h4>
                    <span class="avatar-sm">
                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                            <i class="bx bx-purchase-tag text-primary"></i>
                        </span>
                    </span>
                </div>
                <a href="{{ route('admin.all-offers') }}" class="text-decoration-underline">Manage Offers</a>
            </div>
        </div>
    </div>

    {{-- Rewards --}}
   <div class="col-xl-3 col-md-6">
    <div class="card card-animate">
        <div class="card-body">
            <p class="text-uppercase fw-medium text-muted mb-0">Plans</p>

            <div class="d-flex align-items-end justify-content-between mt-4">
                <h4 class="fs-22 fw-semibold">
                    <span class="counter-value" data-target="{{ $data['totalPlans'] }}">
                        {{ $data['totalPlans'] }}
                    </span>
                </h4>

                <span class="avatar-sm">
                    <span class="avatar-title bg-info-subtle rounded fs-3">
                        <i class="ri-price-tag-3-line text-info"></i>
                    </span>
                </span>
            </div>

            <a href="{{ route('admin.admin.plan') }}" class="text-decoration-underline">
                Manage Plans
            </a>
        </div>
    </div>
</div>


</div>

{{-- RECENT PROVIDERS + QUICK ACTIONS --}}
<div class="row">

    {{-- Recent Service Providers --}}
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title mb-0 flex-grow-1">Recent Service Provider Applications</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Service Type</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProviders ?? [] as $provider)
                            <tr>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->service_type ?? 'N/A' }}</td>
                                <td>{{ $provider->created_at->format('d M, Y') }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $provider->status == 'approved'
                                            ? 'bg-success-subtle text-success'
                                            : 'bg-warning-subtle text-warning' }}">
                                        {{ ucfirst($provider->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No recent applications found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Quick Actions</h4>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="#" class="btn btn-primary btn-label">
                    <i class="ri-user-add-line label-icon me-2"></i> Add New Provider
                </a>

                <a href="{{ route('admin.pending-approvals') }}" class="btn btn-info btn-label">
                    <i class="ri-file-list-3-line label-icon me-2"></i> Review Approvals
                </a>

                <a href="{{ route('admin.all-ads') }}" class="btn btn-warning btn-label">
                    <i class="ri-advertisement-line label-icon me-2"></i> Manage Ads
                </a>

                <a href="{{ route('admin.all-offers') }}" class="btn btn-success btn-label">
                    <i class="ri-list-check label-icon me-2"></i> Manage Offers
                </a>
            </div>
        </div>
    </div>

</div>

@endsection

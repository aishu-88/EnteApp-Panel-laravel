{{-- resources/views/admin/vendors/approved.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Approved Vendors</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Approved Vendors</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Approved Vendors Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Approved Vendors ({{ $vendors->total() }} total)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name / Shop</th>
                                    <th>Owner</th>
                                    <th>Category</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>Joined Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vendors as $vendor)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ $vendor->photo ? asset('storage/' . $vendor->photo) : asset('assets/images/default-shop.png') }}"
                                                        alt="{{ $vendor->shop_name }}" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">{{ $vendor->shop_name }}</div>
                                            </div>
                                        </td>

                                        <td>{{ $vendor->owner_name ?? ($vendor->provider->name ?? 'N/A') }}</td>

                                        <td>
                                            {{ $vendor->mainCategory->name ?? '-' }} /
                                            {{ $vendor->category->name ?? '-' }}
                                        </td>

                                        <td>{{ $vendor->plan->title ?? 'Plan ' . $vendor->plan_id }}</td>

                                        <td>
                                            <span class="badge {{ $vendor->verification_status === 'Approved' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $vendor->verification_status }}
                                            </span>
                                        </td>

                                        <td>{{ $vendor->created_at->format('Y-m-d') }}</td>

                                        <td>
                                            {{-- Approve Button --}}
                                            @if ($vendor->verification_status !== 'Approved')
                                                <form action="{{ route('admin.vendors.approve', $vendor->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Approve this vendor?')">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.vendor.delete', $vendor->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this vendor?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                No approved vendors found.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if (method_exists($vendors, 'links'))
                        <div class="d-flex justify-content-end mt-3">
                            {{ $vendors->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col">
                <h4 class="mb-0">Vendors Awaiting Verification</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Employee Name</th>
                                <th>Shop Name</th>
                                <th>Owner</th>
                                <th>Mobile</th>
                                <th>Main Category</th>
                                <th>Category</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($vendors as $vendor)
                                <tr>

                                    {{-- Provider ID --}}
                                    <td>
                                        {{ $vendor->provider->name ?? 'N/A' }}
                                    </td>


                                    <td>{{ $vendor->shop_name }}</td>
                                    <td>{{ $vendor->owner_name ?? '-' }}</td>
                                    <td>{{ $vendor->mobile }}</td>
                                    <td>{{ $vendor->mainCategory->name ?? '-' }}</td>
                                    <td>{{ $vendor->category->name ?? '-' }}</td>
                                    <td>{{ $vendor->plan_id ?? '-' }}</td>

                                    <td>
                                        <span class="badge bg-warning">
                                            {{ ucfirst($vendor->verification_status) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{-- View --}}
                                        <a href="{{ route('admin.vendor.show', $vendor->id) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>

                                        {{-- Approve --}}
                                        <form action="{{ route('admin.vendor.approve', $vendor->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-success"
                                                onclick="return confirm('Approve this vendor?')">
                                                Approve
                                            </button>
                                        </form>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.vendor.delete', $vendor->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this vendor?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        No pending vendors found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- resources/views/provider/edit_vendor.blade.php --}}
@extends('layouts.provider')

@section('title', 'Edit Vendor')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Edit Vendor</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('provider.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Vendor</li>
            </ol>
        </div>
    </div>
</div>

{{-- Flash Messages --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="ri-checkbox-circle-line me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="ri-error-warning-line me-1"></i>
    <strong>Please fix the following errors:</strong>
    <ul class="mt-2 mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('provider.vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Vendor Details</h5>

                    <div class="row g-3">

                        {{-- Shop Name --}}
                        <div class="col-md-6">
                            <label class="form-label">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" name="shop_name" class="form-control" value="{{ $vendor->shop_name }}" required>
                        </div>

                        {{-- Main Category --}}
                        <div class="col-md-6">
                            <label class="form-label">Main Category <span class="text-danger">*</span></label>
                            <select id="main_category" name="main_category_id" class="form-select" required>
                                <option value="">Select Main Category</option>
                                @foreach ($mainCategories as $main)
                                    <option value="{{ $main->id }}" {{ $vendor->main_category_id == $main->id ? 'selected' : '' }}>
                                        {{ $main->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $vendor->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Owner Name --}}
                        <div class="col-md-6">
                            <label class="form-label">Owner Name</label>
                            <input type="text" name="owner_name" class="form-control" value="{{ $vendor->owner_name }}">
                        </div>

                        {{-- Mobile --}}
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" name="mobile" class="form-control" value="{{ $vendor->mobile }}" required>
                        </div>

                        {{-- WhatsApp --}}
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="tel" name="whatsapp" class="form-control" value="{{ $vendor->whatsapp }}">
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6">
                            <label class="form-label">Address & Ward / Area</label>
                            <input type="text" name="address" class="form-control" value="{{ $vendor->address }}">
                        </div>

                        {{-- Panchayath --}}
                        <div class="col-md-6">
                            <label class="form-label">Panchayath / Locality</label>
                            <input type="text" name="panchayath" class="form-control" value="{{ $vendor->panchayath }}">
                        </div>

                        {{-- Google Map --}}
                        <div class="col-md-6">
                            <label class="form-label">Google Map Location</label>
                            <input type="url" name="google_map" class="form-control" value="{{ $vendor->google_map }}">
                        </div>

                        {{-- Opening Time --}}
                        <div class="col-md-3">
                            <label class="form-label">Opening Time</label>
                            <input type="time" name="opening_time" class="form-control" value="{{ $vendor->opening_time }}">
                        </div>

                        {{-- Closing Time --}}
                        <div class="col-md-3">
                            <label class="form-label">Closing Time</label>
                            <input type="time" name="closing_time" class="form-control" value="{{ $vendor->closing_time }}">
                        </div>

                        {{-- Service Area --}}
                        <div class="col-12">
                            <label class="form-label">Service Coverage Area</label>
                            <input type="text" name="service_area" class="form-control" value="{{ $vendor->service_area }}">
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ $vendor->description }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Uploads & Plan</h5>

                    {{-- Shop Photo --}}
                    <div class="mb-3">
                        <label class="form-label">Shop / Person Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                        @if($vendor->photo)
                            <img src="{{ asset('storage/' . $vendor->photo) }}" class="img-fluid mt-2" width="100">
                        @endif
                    </div>

                    {{-- Additional Images --}}
                    <div class="mb-3">
                        <label class="form-label">Additional Images</label>
                        <input type="file" name="gallery[]" class="form-control" multiple>
                    </div>

                    {{-- Plan --}}
                    <div class="mb-3">
                        <label class="form-label">Plan Selection <span class="text-danger">*</span></label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select Plan</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ $vendor->plan_id == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->title }} – ₹{{ $plan->amount }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line me-1"></i> Update Vendor
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainCategory = document.getElementById('main_category');
    const categorySelect = document.getElementById('category_id');

    mainCategory.addEventListener('change', function() {
        const mainId = this.value;
        categorySelect.innerHTML = '<option value="">Loading...</option>';
        categorySelect.disabled = true;

        fetch(`/provider/sub-categories/by-main/${mainId}`)
            .then(response => response.json())
            .then(data => {
                categorySelect.innerHTML = '<option value="">Select Category</option>';
                data.forEach(cat => {
                    const selected = {{ $vendor->category_id }} == cat.id ? 'selected' : '';
                    categorySelect.innerHTML += `<option value="${cat.id}" ${selected}>${cat.name}</option>`;
                });
                categorySelect.disabled = false;
            })
            .catch(error => {
                console.error(error);
                categorySelect.innerHTML = '<option value="">Error loading categories</option>';
            });
    });
});
</script>
@endpush

@endsection

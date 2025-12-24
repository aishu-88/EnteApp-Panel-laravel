@extends('layouts.provider')

@section('title', 'Add Vendor')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Add New Vendor</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('provider.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add Vendor</li>
            </ol>
        </div>
    </div>
</div>

<form action="{{ route('provider.vendors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

        {{-- ================= LEFT COLUMN ================= --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Vendor Details</h5>

                    <div class="row g-3">

                        {{-- Shop Name --}}
                        <div class="col-md-6">
                            <label class="form-label">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" name="shop_name" class="form-control" required>
                        </div>

                        {{-- Main Category --}}
                        <div class="col-md-6">
                            <label class="form-label">Main Category <span class="text-danger">*</span></label>
                            <select id="main_category"
                                name="main_category_id"
                                class="form-select"
                                required>
                                <option value="">Select Main Category</option>

                                @foreach($mainCategories as $main)
                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Category --}}
                        <div class="col-md-6">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select id="category_id"
                                name="category_id"
                                class="form-select"
                                required
                                disabled>
                                <option value="">Select Category</option>
                            </select>
                        </div>


                        {{-- Owner --}}
                        <div class="col-md-6">
                            <label class="form-label">Owner Name</label>
                            <input type="text" name="owner_name" class="form-control">
                        </div>

                        {{-- Mobile --}}
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" name="mobile" class="form-control" required>
                        </div>

                        {{-- WhatsApp --}}
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="tel" name="whatsapp" class="form-control">
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6">
                            <label class="form-label">Address & Ward / Area</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        {{-- Panchayath --}}
                        <div class="col-md-6">
                            <label class="form-label">Panchayath / Locality</label>
                            <input type="text" name="panchayath" class="form-control">
                        </div>

                        {{-- Google Map --}}
                        <div class="col-md-6">
                            <label class="form-label">Google Map Location</label>
                            <input type="url" name="google_map" class="form-control"
                                placeholder="https://maps.google.com/...">
                        </div>

                        {{-- Opening --}}
                        <div class="col-md-3">
                            <label class="form-label">Opening Time</label>
                            <input type="time" name="opening_time" class="form-control">
                        </div>

                        {{-- Closing --}}
                        <div class="col-md-3">
                            <label class="form-label">Closing Time</label>
                            <input type="time" name="closing_time" class="form-control">
                        </div>

                        {{-- Service Area --}}
                        <div class="col-12">
                            <label class="form-label">Service Coverage Area</label>
                            <input type="text" name="service_area" class="form-control">
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="description" rows="3" class="form-control"></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- ================= RIGHT COLUMN ================= --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Uploads & Plan</h5>

                    <div class="mb-3">
                        <label class="form-label">Shop / Person Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Additional Images</label>
                        <input type="file" name="gallery[]" class="form-control" multiple>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plan Selection <span class="text-danger">*</span></label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select Plan</option>
                            @for($i=1;$i<=10;$i++)
                                <option value="{{ $i }}">Plan {{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="alert alert-info">
                        Vendor will be saved with <strong>Verification Status: Pending</strong>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line me-1"></i> Save Vendor
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</form>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const mainCategory = document.getElementById('main_category');
    const categorySelect = document.getElementById('category_id');

    mainCategory.addEventListener('change', function () {

        const mainId = this.value;

        if (!mainId) {
            categorySelect.innerHTML = '<option value="">Select Category</option>';
            categorySelect.disabled = true;
            return;
        }

        categorySelect.innerHTML = '<option value="">Loading...</option>';
        categorySelect.disabled = true;

        fetch(`/provider/sub-categories/by-main/${mainId}`)
            .then(response => response.json())
            .then(data => {

                categorySelect.innerHTML = '<option value="">Select Category</option>';

                if (data.length === 0) {
                    categorySelect.innerHTML += '<option value="">No categories found</option>';
                } else {
                    data.forEach(cat => {
                        categorySelect.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                    });
                }

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



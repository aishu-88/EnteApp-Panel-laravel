@extends('layouts.provider')

@section('title', 'Add Vendor')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Add New Vendor</h4>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('provider.vendors.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">

{{-- ================= LEFT ================= --}}
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

{{-- Owner Name --}}
<div class="col-md-6">
<label class="form-label">Owner Name</label>
<input type="text" name="owner_name" class="form-control">
</div>


{{-- Main Category --}}
<div class="col-md-6">
<label class="form-label">Main Category <span class="text-danger">*</span></label>
<select name="main_category_id" id="main_category" class="form-select" required>
<option value="">Select</option>
@foreach($mainCategories as $main)
<option value="{{ $main->id }}">{{ $main->name }}</option>
@endforeach
</select>
</div>

{{-- Category --}}
<div class="col-md-6">
<label class="form-label">Category <span class="text-danger">*</span></label>
<select name="category_id" id="category_id" class="form-select" required disabled>
<option value="">Select</option>
</select>
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
<label class="form-label">Address</label>
<input type="text" name="address" class="form-control">
</div>

{{-- Google Map --}}
<div class="col-md-6">
<label class="form-label">Google Map Location</label>
<input type="url" name="google_map" class="form-control">
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
<div class="col-md-6">
<label class="form-label">Service Area</label>
<input type="text" name="service_area" class="form-control">
</div>

{{-- Special Recommendation --}}
<div class="col-12">
<label class="form-label">Special Recommendation</label>
<textarea name="special_recommendation" class="form-control" rows="2"></textarea>
</div>

</div>
</div>
</div>
</div>

{{-- ================= RIGHT ================= --}}
<div class="col-lg-4">
<div class="card">
<div class="card-body">

<h5 class="mb-4">Plan & Payment</h5>

{{-- Photo --}}
<div class="mb-3">
<label class="form-label">Shop / Person Photo</label>
<input type="file" name="photo" class="form-control">
</div>

{{-- Gallery --}}
<div class="mb-3">
<label class="form-label">Gallery Images</label>
<input type="file" name="gallery[]" class="form-control" multiple>
</div>

{{-- Plan --}}
<div class="mb-3">
<label class="form-label">Plan <span class="text-danger">*</span></label>
<select name="plan_id" class="form-select" required>
<option value="">Select</option>
@foreach($plans as $plan)
<option value="{{ $plan->id }}">{{ $plan->title }} - ₹{{ $plan->amount }}</option>
@endforeach
</select>
</div>

{{-- Payment Mode --}}
<div class="mb-3">
<label class="form-label">Mode of Plan <span class="text-danger">*</span></label>
<select name="payment_mode" id="payment_mode" class="form-select" required>
<option value="">Select</option>
<option value="gpay">GPay</option>
<option value="bank_transfer">Bank Transfer</option>
<option value="cash">Cash</option>
</select>
</div>

{{-- Transaction ID --}}
<div class="mb-3 d-none" id="transaction_box">
<label class="form-label">Transaction ID</label>
<input type="text" name="transaction_id" class="form-control">
</div>

{{-- Reference Number --}}
<div class="mb-3">
<label class="form-label">Reference Number</label>
<input type="text" name="reference_number" class="form-control">
</div>

<div class="alert alert-info small">
Vendor will remain inactive until admin approval.
</div>

<button class="btn btn-primary w-100">Save Vendor</button>

</div>
</div>
</div>

</div>
</form>

@endsection

@push('scripts')
<script>
document.getElementById('payment_mode').addEventListener('change', function () {
    const box = document.getElementById('transaction_box');
    const input = box.querySelector('input');

    if (this.value === 'gpay' || this.value === 'bank_transfer') {
        box.classList.remove('d-none');
    } else {
        box.classList.add('d-none');
        input.value = '';
    }
});

// Load categories dynamically
document.getElementById('main_category').addEventListener('change', function () {
    fetch(`/provider/sub-categories/by-main/${this.value}`)
        .then(res => res.json())
        .then(data => {
            const cat = document.getElementById('category_id');
            cat.innerHTML = '<option value="">Select</option>';
            cat.disabled = false;

            data.forEach(d => {
                cat.innerHTML += `<option value="${d.id}">${d.name}</option>`;
            });
        });
});
</script>
@endpush

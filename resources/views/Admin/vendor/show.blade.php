@extends('layouts.provider')

@section('title', 'Edit Vendor')

@section('content')
@if (session('success'))
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    });
</script>
@endpush
@endif
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Please fix the errors and try again'
    });
</script>
@endif

<form action="{{ route('provider.vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- ================= SHOP DETAILS ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-store-2-line me-1"></i> Shop Details</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Shop Name *</label>
                    <input type="text" name="shop_name" class="form-control" required value="{{ old('shop_name', $vendor->shop_name) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Owner Name</label>
                    <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $vendor->owner_name) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile *</label>
                    <input type="tel" name="mobile" class="form-control" required value="{{ old('mobile', $vendor->mobile) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">WhatsApp</label>
                    <input type="tel" name="whatsapp" class="form-control" value="{{ old('whatsapp', $vendor->whatsapp) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $vendor->email) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">DIGIPIN</label>
                    <input type="text" name="digipin" id="digipin" maxlength="10" class="form-control" value="{{ old('digipin', $vendor->digipin) }}">
                    <small id="digipin_msg"></small>
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $vendor->address) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Google Map URL</label>
                    <input type="url" name="google_map" class="form-control" value="{{ old('google_map', $vendor->google_map) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Service Area</label>
                    <input type="text" name="service_area" class="form-control" value="{{ old('service_area', $vendor->service_area) }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ================= CATEGORY & PLAN ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-list-check-2 me-1"></i> Category & Plan</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Main Category <span class="text-danger">*</span></label>
                    <select name="main_category_id" id="main_category" class="form-select" required>
                        <option value="">Select</option>
                        @foreach ($mainCategories as $main)
                        <option value="{{ $main->id }}" {{ $vendor->main_category_id == $main->id ? 'selected' : '' }}>
                            {{ $main->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Select</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $vendor->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Plan <span class="text-danger">*</span></label>
                    <select name="plan_id" class="form-select" required>
                        <option value="">Select</option>
                        @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}" {{ $vendor->plan_id == $plan->id ? 'selected' : '' }}>
                            {{ $plan->title }} - ₹{{ $plan->amount }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TIMINGS ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-time-line me-1"></i> Working Hours</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Opening Time</label>
                    <input type="time" name="opening_time" class="form-control" value="{{ old('opening_time', $vendor->opening_time) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Closing Time</label>
                    <input type="time" name="closing_time" class="form-control" value="{{ old('closing_time', $vendor->closing_time) }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ================= SOCIAL MEDIA ================= --}}
    @if(is_array($vendor->social_links))
    @foreach ($vendor->social_links as $social)
    @if(is_array($social))
    <div class="row g-2 mb-2 social-row">

        <div class="col-md-4">
            <select name="social_type[]" class="form-select">
                <option value="instagram" {{ ($social['type'] ?? '') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="facebook" {{ ($social['type'] ?? '') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="website" {{ ($social['type'] ?? '') == 'website' ? 'selected' : '' }}>Website</option>
            </select>
        </div>

        <div class="col-md-7">
            <input type="url" name="social_link[]" class="form-control" value="{{ $social['link'] ?? '' }}">
        </div>

        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-danger remove-social">
                <i class="ri-close-line"></i>
            </button>
        </div>

    </div>
    @endif
    @endforeach
    @endif


    {{-- ================= IMAGES ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-image-line me-1"></i> Images</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if($vendor->photo)
                    <img src="{{ asset('storage/'.$vendor->photo) }}" class="img-thumbnail mt-2" width="120" id="photoPreview">
                    @else
                    <img id="photoPreview" class="img-thumbnail mt-2 d-none" width="120">
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gallery</label>
                    <input type="file" name="gallery[]" id="gallery" multiple class="form-control">
                    <div id="galleryPreview" class="d-flex gap-2 mt-2 flex-wrap">
                        @if(!empty($vendor->gallery))
                        @foreach($vendor->gallery as $img)
                        <img src="{{ asset('storage/'.$img) }}" class="img-thumbnail" style="width:90px;">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= PAYMENT ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-bank-card-line me-1"></i> Payment</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Payment Mode *</label>
                    <select name="payment_mode" id="payment_mode" class="form-select" required>
                        <option value="">Select</option>
                        <option value="gpay" {{ $vendor->payment_mode=='gpay' ? 'selected':'' }}>GPay</option>
                        <option value="bank_transfer" {{ $vendor->payment_mode=='bank_transfer' ? 'selected':'' }}>Bank Transfer</option>
                        <option value="cash" {{ $vendor->payment_mode=='cash' ? 'selected':'' }}>Cash</option>
                    </select>
                </div>
                <div class="col-md-6 {{ in_array($vendor->payment_mode,['gpay','bank_transfer'])?'':'d-none' }}" id="transaction_box">
                    <label class="form-label">Transaction ID</label>
                    <input type="text" name="transaction_id" class="form-control" value="{{ $vendor->transaction_id }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Reference Number</label>
                    <input type="text" name="reference_number" class="form-control" value="{{ $vendor->reference_number }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ================= COMMENTS ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4"><i class="ri-chat-quote-line me-1"></i> Comments</h5>
            <textarea name="special_recommendation" class="form-control mb-2" rows="2" placeholder="Special Recommendation">{{ old('special_recommendation', $vendor->special_recommendation) }}</textarea>
            <textarea name="internal_comments" class="form-control" rows="2" placeholder="Internal Notes">{{ old('internal_comments', $vendor->internal_comments) }}</textarea>
        </div>
    </div>

    <button class="btn btn-primary btn-lg w-100">
        <i class="ri-save-line"></i> Update Vendor
    </button>
</form>
@endsection

@push('scripts')
<script>
    /* SOCIAL */
    document.getElementById('add-social').addEventListener('click', () => {
        document.getElementById('social-wrapper').insertAdjacentHTML('beforeend', `
<div class="row g-2 mb-2 social-row">
    <div class="col-md-4">
        <select name="social_type[]" class="form-select">
            <option value="instagram">Instagram</option>
            <option value="facebook">Facebook</option>
            <option value="website">Website</option>
        </select>
    </div>
    <div class="col-md-7">
        <input type="url" name="social_link[]" class="form-control">
    </div>
    <div class="col-md-1 text-end">
        <button type="button" class="btn btn-danger remove-social"><i class="ri-close-line"></i></button>
    </div>
</div>`);
    });

    document.addEventListener('click', e => {
        if (e.target.closest('.remove-social')) {
            e.target.closest('.social-row').remove();
        }
    });

    /* DIGIPIN */
    document.getElementById('digipin').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        const msg = document.getElementById('digipin_msg');
        /^[A-Z0-9]{10}$/.test(this.value) ?
            (msg.textContent = 'Valid DIGIPIN', msg.className = 'text-success') :
            (msg.textContent = 'Invalid DIGIPIN', msg.className = 'text-danger');
    });

    /* PAYMENT TOGGLE */
    document.getElementById('payment_mode').addEventListener('change', function() {
        document.getElementById('transaction_box').classList.toggle(
            'd-none', this.value === 'cash' || this.value === ''
        );
    });

    /* IMAGE PREVIEW */
    photo.onchange = e => {
        photoPreview.src = URL.createObjectURL(e.target.files[0]);
        photoPreview.classList.remove('d-none');
    };

    gallery.onchange = e => {
        galleryPreview.innerHTML = '';
        [...e.target.files].forEach(f => {
            let img = document.createElement('img');
            img.src = URL.createObjectURL(f);
            img.className = 'img-thumbnail';
            img.style.width = '90px';
            galleryPreview.appendChild(img);
        });
    };

    // Load categories dynamically
    document.getElementById('main_category').addEventListener('change', function() {
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
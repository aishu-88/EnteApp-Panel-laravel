@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Edit Advertisement</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Advertisements</a></li>
                        <li class="breadcrumb-item active">Edit Ad</li>
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

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Edit Ad Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Advertisement</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.all-ads') }}" class="btn btn-soft-secondary btn-sm material-shadow-none">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Ads
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.admin.ads.update', $ad->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Ad Title --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ad Title</label>
                                    <input type="text"
                                           class="form-control @error('adTitle') is-invalid @enderror"
                                           name="adTitle"
                                           value="{{ old('adTitle', $ad->title) }}"
                                           required>
                                    @error('adTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select @error('adStatus') is-invalid @enderror"
                                            name="adStatus"
                                            required>
                                        <option value="active" {{ old('adStatus', $ad->status) == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ old('adStatus', $ad->status) == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                    @error('adStatus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Dates --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date"
                                           class="form-control @error('startDate') is-invalid @enderror"
                                           name="startDate"
                                           value="{{ old('startDate', $ad->start_date) }}"
                                           required>
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date"
                                           class="form-control @error('endDate') is-invalid @enderror"
                                           name="endDate"
                                           value="{{ old('endDate', $ad->end_date) }}"
                                           required>
                                    @error('endDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Media --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ad Image / Video</label>
                                    <input type="file"
                                           class="form-control @error('adImage') is-invalid @enderror"
                                           name="adImage"
                                           accept="image/*,video/*">
                                    <small class="text-muted">Leave empty to keep existing media</small>
                                    @error('adImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($ad->media)
                                    <div class="mt-2">
                                        <strong>Current Media:</strong><br>
                                        <img src="{{ asset('storage/'.$ad->media) }}"
                                             class="img-fluid rounded"
                                             style="max-height:120px;">
                                    </div>
                                @endif
                            </div>

                            {{-- Target URL --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Target URL</label>
                                    <input type="url"
                                           class="form-control @error('targetUrl') is-invalid @enderror"
                                           name="targetUrl"
                                           value="{{ old('targetUrl', $ad->target_url) }}">
                                    @error('targetUrl')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Ad</button>
                            <a href="{{ route('admin.all-ads') }}" class="btn btn-secondary ms-2">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

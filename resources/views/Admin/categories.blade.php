{{-- resources/views/admin/listings/categories.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Service Categories
    $serviceCategories = collect([
        (object) [
            'id' => 1,
            'name' => 'Electrician',
            'type' => 'service',
            'icon' => 'ri-plug-2-line',
            'description' => 'Wiring, repairs, and installations',
            'listings_count' => 45,
            'active_count' => 12,
        ],
        (object) [
            'id' => 2,
            'name' => 'Driver',
            'type' => 'service',
            'icon' => 'ri-car-line',
            'description' => 'Transportation and delivery',
            'listings_count' => 32,
            'active_count' => 8,
        ],
        (object) [
            'id' => 3,
            'name' => 'Plumber',
            'type' => 'service',
            'icon' => 'ri-wrench-line',
            'description' => 'Pipes, leaks, and fixtures',
            'listings_count' => 28,
            'active_count' => 10,
        ],
        (object) [
            'id' => 4,
            'name' => 'Beauty',
            'type' => 'service',
            'icon' => 'ri-scissors-line',
            'description' => 'Salon, spa, and grooming',
            'listings_count' => 56,
            'active_count' => 15,
        ],
        (object) [
            'id' => 5,
            'name' => 'Fitness',
            'type' => 'service',
            'icon' => 'ri-run-line',
            'description' => 'Gyms, trainers, and yoga',
            'listings_count' => 41,
            'active_count' => 9,
        ],
        (object) [
            'id' => 6,
            'name' => 'Repair',
            'type' => 'service',
            'icon' => 'ri-tools-line',
            'description' => 'Home and appliance fixes',
            'listings_count' => 37,
            'active_count' => 11,
        ],
    ]);

    // Dummy data for Shop Categories
    $shopCategories = collect([
        (object) [
            'id' => 7,
            'name' => 'Grocery',
            'type' => 'shop',
            'icon' => 'ri-shopping-bag-line',
            'description' => 'Food and essentials',
            'listings_count' => 78,
            'active_count' => 20,
        ],
        (object) [
            'id' => 8,
            'name' => 'Mobile',
            'type' => 'shop',
            'icon' => 'ri-smartphone-line',
            'description' => 'Phones and accessories',
            'listings_count' => 64,
            'active_count' => 18,
        ],
        (object) [
            'id' => 9,
            'name' => 'Fashion',
            'type' => 'shop',
            'icon' => 'ri-t-shirt-line',
            'description' => 'Clothing and apparel',
            'listings_count' => 52,
            'active_count' => 14,
        ],
        (object) [
            'id' => 10,
            'name' => 'Books',
            'type' => 'shop',
            'icon' => 'ri-bookmark-line',
            'description' => 'Literature and stationery',
            'listings_count' => 29,
            'active_count' => 7,
        ],
        (object) [
            'id' => 11,
            'name' => 'Electronics',
            'type' => 'shop',
            'icon' => 'ri-camera-line',
            'description' => 'Gadgets and appliances',
            'listings_count' => 48,
            'active_count' => 13,
        ],
        (object) [
            'id' => 12,
            'name' => 'Florist',
            'type' => 'shop',
            'icon' => 'ri-flower-line',
            'description' => 'Flowers and gifts',
            'listings_count' => 23,
            'active_count' => 6,
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Categories</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all-listings') }}">Listings</a></li>
                        <li class="breadcrumb-item active">All Categories</li>
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

    {{-- Services Categories Section --}}
    <div class="row">
        <div class="col-12">
            <div class="category-section">
                <h5 class="mb-4 text-center">Service Categories</h5>
                <div class="row">
                    @foreach($serviceCategories as $category)
                        <div class="col-md-6 col-lg-4">
                            <div class="card category-item service-category text-center">
                                <div class="category-icon">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <h6 class="mb-2">{{ $category->name }}</h6>
                                <p class="text-muted small mb-3">{{ $category->description }}</p>
                                <div class="category-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">{{ $category->listings_count }}</div>
                                        <div class="text-muted small">Listings</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">{{ $category->active_count }}</div>
                                        <div class="text-muted small">Active</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-1">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Shops Categories Section --}}
    <div class="row">
        <div class="col-12">
            <div class="category-section">
                <h5 class="mb-4 text-center">Shop Categories</h5>
                <div class="row">
                    @foreach($shopCategories as $category)
                        <div class="col-md-6 col-lg-4">
                            <div class="card category-item shop-category text-center">
                                <div class="category-icon">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <h6 class="mb-2">{{ $category->name }}</h6>
                                <p class="text-muted small mb-3">{{ $category->description }}</p>
                                <div class="category-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">{{ $category->listings_count }}</div>
                                        <div class="text-muted small">Listings</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">{{ $category->active_count }}</div>
                                        <div class="text-muted small">Active</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-1">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Add Category Floating Button --}}
    <button class="add-category-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="ri-add-line"></i>
    </button>

    {{-- Add Category Modal --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="e.g., Cleaning Services">
                        </div>
                        <div class="mb-3">
                            <label for="categoryType" class="form-label">Type</label>
                            <select class="form-select" id="categoryType">
                                <option>Service</option>
                                <option>Shop</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categoryIcon" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="categoryIcon" placeholder="e.g., ri-broom-line">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Category</button>
                </div>
            </div>
        </div>
    </div>
@endsection
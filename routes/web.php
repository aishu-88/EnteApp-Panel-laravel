<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    LoginController,
    LogoutController,
    DashboardController,
    UserController,
    ListingController,
    StaffController,
    AdvertisementController,
    OfferController,
    RewardController,
    GiftCardController,
    InformationController,
    ReportController,
    SettingController,
    ProfileController
};
use App\Http\Controllers\provider\{
    DashboardController as ProviderDashboardController,
    VendorController,
    ProviderProfileController
};

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    // Logout (POST only)
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])   // 👈 custom AdminMiddleware
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Users
        Route::get('/users/all', [UserController::class, 'allUsers'])->name('all-users');
        Route::get('/users/service-providers', [UserController::class, 'serviceProviders'])->name('service-providers');
        Route::get('/users/shop-owners', [UserController::class, 'shopOwners'])->name('shop-owners');
        Route::get('/users/verification-requests', [UserController::class, 'verificationRequests'])->name('verification-requests');
        Route::get('/users/blocked', [UserController::class, 'blockedUsers'])->name('blocked-users');
        // Listings
        Route::get('/listings/all', [ListingController::class, 'allListings'])->name('all-listings');
        Route::get('/listings/pending-approvals', [ListingController::class, 'pendingApprovals'])->name('pending-approvals');
        Route::get('/listings/featured', [ListingController::class, 'featuredListings'])->name('featured-listings');
        Route::get('/listings/categories', [ListingController::class, 'categories'])->name('categories');
        Route::post('/admin/categories',[CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

        // Update category
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

        // Delete category
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


        // Staff
        Route::get('/staff/employees', [StaffController::class, 'employees'])->name('employees');
        Route::get('/staff/roles-permissions', [StaffController::class, 'rolesPermissions'])->name('roles-permissions');
        Route::get('/staff/activity-logs', [StaffController::class, 'activityLogs'])->name('activity-logs');
        // Ads
        Route::get('/advertisements/all', [AdvertisementController::class, 'allAds'])->name('all-ads');
        Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('create-ads');
        Route::get('/advertisements/pending', [AdvertisementController::class, 'pendingAds'])->name('pending-ads');
        Route::get('/advertisements/slots', [AdvertisementController::class, 'adSlotsManagement'])->name('ad-slots-management');
        // Offers
        Route::get('/offers/all', [OfferController::class, 'allOffers'])->name('all-offers');
        Route::get('/offers/create', [OfferController::class, 'create'])->name('create-offer');
        Route::get('/offers/scheduled', [OfferController::class, 'scheduledOffers'])->name('scheduled-offers');
        // Rewards
        Route::get('/rewards/daily-challenges', [RewardController::class, 'dailyChallenges'])->name('daily-challenges');
        Route::get('/rewards/spin-win', [RewardController::class, 'spinWin'])->name('spin-win');
        Route::get('/rewards/scratch-cards', [RewardController::class, 'scratchCards'])->name('scratch-cards');
        Route::get('/rewards/rules', [RewardController::class, 'rewardRules'])->name('reward-rules');
        // Gift Cards
        Route::get('/gift-cards/management', [GiftCardController::class, 'giftCardManagement'])->name('gift-card-management');
        Route::get('/gift-cards/wallet-transactions', [GiftCardController::class, 'walletTransactions'])->name('wallet-transactions');
        Route::get('/gift-cards/redemption-requests', [GiftCardController::class, 'redemptionRequests'])->name('redemption-requests');
        // Information
        Route::get('/information/panchayath-notices', [InformationController::class, 'panchayathNotices'])->name('panchayath-notices');
        Route::get('/information/emergency-contacts', [InformationController::class, 'emergencyContacts'])->name('emergency-contacts');
        Route::get('/information/local-announcements', [InformationController::class, 'localAnnouncements'])->name('local-announcements');
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        // Settings
        Route::get('/settings/general', [SettingController::class, 'generalSettings'])->name('general-settings');
        Route::get('/settings/app-configuration', [SettingController::class, 'appConfiguration'])->name('app-configuration');
        Route::get('/settings/locality-setup', [SettingController::class, 'localitySetup'])->name('locality-setup');
        Route::get('/settings/notifications', [SettingController::class, 'notificationSettings'])->name('notification-settings');
        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


/*
|--------------------------------------------------------------------------
| SERVICE PROVIDER PANEL (Protected)
|--------------------------------------------------------------------------
*/
Route::get('/sub-categories/by-main/{id}', 
    [CategoryController::class, 'getByMain']);

Route::middleware(['auth', 'service_provider'])->prefix('provider')->name('provider.')->group(function () {  // 👈 Fixed: Group name prefix is correct
    Route::get('/dashboard', function () {
        return view('provider.dashboard');
    })->name('dashboard');

    // Add Vendor Routes
    Route::get('/add-vendor', [VendorController::class, 'create'])->name('add-vendor');
    Route::post('/add-vendor', [VendorController::class, 'store']);
    Route::get('/categories/by-type', [CategoryController::class, 'getCategoriesByType'])->name('categories.byType');
    // Vendor List Routes
    Route::get('/vendor-list', [VendorController::class, 'index'])->name('vendor-list');

    // Profile Routes (shared with Admin ProfileController)
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')
        ->middleware(['auth', 'role:admin'])
        ->group(function () {

            Route::get('/profile', [ProfileController::class, 'edit'])
                ->name('admin.profile');

            Route::patch('/profile', [ProfileController::class, 'update'])
                ->name('admin.profile.update');

            Route::delete('/profile', [ProfileController::class, 'destroy'])
                ->name('admin.profile.destroy');
        });

    Route::get('/profile', [ProviderProfileController::class, 'edit'])
        ->name('profile');

    Route::put('/profile', [ProviderProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/password', [ProviderProfileController::class, 'updatePassword'])
        ->name('password.update');


    // Logout (POST only, shared LogoutController)
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| SHOP OWNER PANEL (Protected) - New Addition
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'shop_owner'])->prefix('shop')->name('shop.')->group(function () {  // 👈 New: Mirror provider structure
    Route::get('/dashboard', function () {
        return view('shop.dashboard');  // 👈 Adjust view name as needed
    })->name('dashboard');  // Full name: 'shop.dashboard'
});

/*
|--------------------------------------------------------------------------
| NORMAL USERS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

require __DIR__ . '/auth.php';

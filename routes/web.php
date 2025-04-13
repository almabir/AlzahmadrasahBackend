<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DonationAreaController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AcademicClassController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\MonthlyFeeController;
use App\Http\Controllers\StudentController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/users', [DashboardController::class, 'users'])->middleware(['auth', 'verified'])->name('dashboard.users');
Route::get('/dashboard/posts', [DashboardController::class, 'posts'])->middleware(['auth', 'verified'])->name('dashboard.posts');
Route::get('/dashboard/posts/create', [DashboardController::class, 'createPost'])->middleware(['auth', 'verified'])->name('dashboard.posts.create');

//SuperAdmin And Admin Only
Route::middleware(['auth', 'verified', 'role:super-admin|admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/permissions', [UserController::class, 'permissions'])->name('admin.users.permissions');
    Route::put('/admin/users/{user}/permissions', [UserController::class, 'updatePermissions'])->name('admin.users.permissions.update');
});

// Domnation Area
Route::prefix('admin/donation-areas')->group(function () {
    Route::get('/', [DonationAreaController::class, 'index'])->name('admin.donation-areas.index');
    Route::get('/create', [DonationAreaController::class, 'create'])->name('admin.donation-areas.create');
    Route::post('/', [DonationAreaController::class, 'store'])->name('admin.donation-areas.store');
    Route::get('/{donationArea}/edit', [DonationAreaController::class, 'edit'])->name('admin.donation-areas.edit');
    Route::put('/{donationArea}', [DonationAreaController::class, 'update'])->name('admin.donation-areas.update');
    Route::delete('/{donationArea}', [DonationAreaController::class, 'destroy'])->name('admin.donation-areas.destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

// Payment Gateway Routes
Route::prefix('admin/payment-gateways')->group(function () {
    Route::get('/', [PaymentGatewayController::class, 'index'])->name('admin.payment-gateways.index');
    Route::get('/create', [PaymentGatewayController::class, 'create'])->name('admin.payment-gateways.create');
    Route::post('/', [PaymentGatewayController::class, 'store'])->name('admin.payment-gateways.store');
    Route::get('/{paymentGateway}/edit', [PaymentGatewayController::class, 'edit'])->name('admin.payment-gateways.edit');
    Route::put('/{paymentGateway}', [PaymentGatewayController::class, 'update'])->name('admin.payment-gateways.update');
    Route::delete('/{paymentGateway}', [PaymentGatewayController::class, 'destroy'])->name('admin.payment-gateways.destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

//Slider Route 
Route::prefix('admin/slider')->name('admin.slider.')->group(function () {
    Route::get('/', [SliderController::class, 'index'])->name('index');
    Route::get('/create', [SliderController::class, 'create'])->name('create');
    Route::post('/', [SliderController::class, 'store'])->name('store');
    Route::get('/{sliderItem}/edit', [SliderController::class, 'edit'])->name('edit');
    Route::put('/{sliderItem}', [SliderController::class, 'update'])->name('update');
    Route::delete('/{sliderItem}', [SliderController::class, 'destroy'])->name('destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

//Page Route 
Route::prefix('admin/pages')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('pages.index');
    Route::get('/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/', [PageController::class, 'store'])->name('pages.store');
    Route::get('/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

// Gallery Routes
Route::prefix('admin/galleries')->group(function () {
    Route::get('/', [GalleryController::class, 'indexView'])->name('galleries.index');
    Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

// Gallery Category Routes
Route::prefix('admin/gallery-categories')->group(function () {
    Route::get('/', [GalleryCategoryController::class, 'indexView'])->name('gallery-categories.index');
    Route::get('/create', [GalleryCategoryController::class, 'create'])->name('gallery-categories.create');
    Route::post('/', [GalleryCategoryController::class, 'store'])->name('gallery-categories.store');
    Route::get('/{galleryCategory}/edit', [GalleryCategoryController::class, 'edit'])->name('gallery-categories.edit');
    Route::put('/{galleryCategory}', [GalleryCategoryController::class, 'update'])->name('gallery-categories.update');
    Route::delete('/{galleryCategory}', [GalleryCategoryController::class, 'destroy'])->name('gallery-categories.destroy');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

// Directors Routes
Route::prefix('admin')->group(function () {
    Route::resource('directors', DirectorController::class);
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
})->middleware(['auth', 'verified', 'role:super-admin|admin']);

// Reports 
Route::get('/students/export', [StudentController::class, 'export']);
Route::resource('academic-classes', AcademicClassController::class);
Route::resource('achievements', AchievementController::class);
Route::resource('fees', FeeController::class);
Route::resource('monthly-fees', MonthlyFeeController::class);
Route::resource('students', StudentController::class);
// PDF Download Route
Route::get('/students/{student}/download-pdf', [StudentController::class, 'downloadPdf'])->name('students.download-pdf');


// Donations Route
Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');


require __DIR__.'/auth.php';

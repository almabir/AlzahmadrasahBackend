<?php
use App\Http\Controllers\Api\SliderApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\VolunteerController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\DonorLifeMemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\Api\DonationAreaController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Api\SettingController;

Route::group(['middleware' => 'api'], function(){
    Route::get('/sliders', [SliderApiController::class, 'index']);
    //Show Page
    Route::get('pages/{slug}', [PageController::class, 'show']); 
 });

 //Volunteer Route
Route::post('/volunteers', [VolunteerController::class, 'store']);
//Members Route
Route::post('/members', [MemberController::class, 'store']);
Route::post('/donor-member', [DonorLifeMemberController::class, 'store']);

//For Payment
Route::post('/initiate-payment', [MemberController::class, 'initiatePayment']);
//For Gallery
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery-categories', [GalleryCategoryController::class, 'index']);
//SMS/Email
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

//Director
Route::get('/directors', [DirectorController::class, 'indexDev']);
Route::get('/directors/{id}', [DirectorController::class, 'singleDir']);
Route::get('/donation-areas', [DonationAreaController::class, 'index']);
Route::get('/donation-areas/{id}', [DonationAreaController::class, 'singIndex']);

// Initialize payment process
Route::post('/payment/initialize', [DonationController::class, 'initializePayment']);
Route::post('/payment/confirm', [DonationController::class, 'confirmPayment']);
Route::post('/payment/ipn', [DonationController::class, 'paymentIPN']);
Route::post('/user-dashboard', [UserDashboardController::class, 'index']);  // Changed to POST
Route::post('/update-address', [UserDashboardController::class, 'updateAddress']);


Route::prefix('settings')->group(function () {
    Route::get('/', [SettingController::class, 'index']); // Get settings
    // Route::put('/', [SettingController::class, 'update']); // Update settings
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



   
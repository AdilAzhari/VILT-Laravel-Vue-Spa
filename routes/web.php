<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// --- Public Routes ---
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::inertia('contact', 'Contact')->name('contact');
Route::inertia('about', 'About')->name('about');

Route::resource('listing', ListingController::class)->only(['index', 'show']);
Route::get('login', [AuthController::class, 'create'])->name('login');

Route::post('login', [AuthController::class, 'store'])->name('login.store');
// --- Authentication & User Account Routes ---
Route::prefix('auth')->group(function () {

    Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);
});

// --- Email Verification Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', fn () => inertia('Auth/VerifyEmail'))
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('listing.index')->with('success', 'Email was verified!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});


// --- Authenticated User Routes ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/hello', [IndexController::class, 'show']); // Consider if 'hello' is still needed or can be integrated elsewhere

    Route::resource('listing.offer', ListingOfferController::class)->only(['store']);

    Route::resource('notification', NotificationController::class)->only(['index']);
    Route::put('notification/{notification}/seen', NotificationSeenController::class)
        ->name('notification.seen');

    // --- Realtor Specific Routes ---
    Route::prefix('realtor')
        ->name('realtor.')
        ->group(function () {
            Route::put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
                ->name('listing.restore')
                ->withTrashed();

            Route::resource('listing', RealtorListingController::class)->withTrashed();

            Route::put('offer/{offer}/accept', RealtorListingAcceptOfferController::class)
                ->name('offer.accept');

            Route::resource('listing.image', RealtorListingImageController::class)
                ->only(['create', 'store', 'destroy']);
        });
});

require __DIR__ . '/auth.php'; // Keep this if you're using Laravel Breeze/Jetstream for auth scaffolding

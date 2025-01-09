<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PaxCategoryController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/package', [HomeController::class, 'package'])->name('package');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('paxCategories/{paxCategoryId}/calculate/{numPax}', [PaxCategoryController::class, 'calculateTotalPrice']);
Route::get('packages/{packageId}/calculate-price/{numPax}', [PaxCategoryController::class, 'calculateTotalPriceWithExtraPax']);
Route::get('/calculate-total-price/{categoryId}/{numPax}', [PaxCategoryController::class, 'calculateTotalPrice']);


Route::resource('sliders', SliderController::class);
Route::resource('packages', PackageController::class);
Route::resource('paxCategories', PaxCategoryController::class);


Route::prefix('bookings')->group(function () {
    Route::post('/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/billing/create/{package_id}', [BookingController::class, 'showBillingForm'])->name('bookings.billing.create');  // Koreksi di sini
    Route::post('/finalize', [BookingController::class, 'finalizeBooking'])->name('bookings.finalize');
    Route::get('/calculate-total-price/{paxCategory}/{numPax}', [BookingController::class, 'calculateTotalPrice']);
    Route::get('/get-price-per-pax/{paxCategory}', [BookingController::class, 'getPricePerPax']);
    Route::get('/billing/payment/{booking}', [BookingController::class, 'payment'])->name('billing.payment');
    


});

// Route::get('/api/full-booked-dates', [BookingController::class, 'getFullBookedDates']);
Route::get('/api/check-availability', [BookingController::class, 'getFullBookedDates']);





<?php

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\PaxCategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Documentation;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/package', [HomeController::class, 'package'])->name('package');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login-process', [LoginController::class, 'login_process'])->name('login-process');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-process', [LoginController::class, 'register_process'])->name('register-process');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('itineraries', ItineraryController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('paxCategories', PaxCategoryController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('documentations', DocumentationController::class);
    Route::patch('bookings/{booking}/toggle-pay', 
    [BookingController::class, 'togglePayStatus'])
    ->name('bookings.togglePay');
});
Route::get('/packages/{package}/detail', [PackageController::class, 'detail'])->name('packages.detail');

Route::prefix('bookings')->group(function () {
    Route::post('/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/billing/create/{package_id}', [BookingController::class, 'showBillingForm'])->name('bookings.billing.create');  // Koreksi di sini
    Route::post('/finalize', [BookingController::class, 'finalizeBooking'])->name('bookings.finalize');
    Route::get('/calculate-total-price/{paxCategory}/{numPax}', [BookingController::class, 'calculateTotalPrice']);
    Route::get('/get-price-per-pax/{paxCategory}', [BookingController::class, 'getPricePerPax']);
    Route::get('/billing/payment/{booking}', [BookingController::class, 'payment'])->name('billing.payment');

});

Route::get('paxCategories/{paxCategoryId}/calculate/{numPax}', [PaxCategoryController::class, 'calculateTotalPrice']);
Route::get('packages/{packageId}/calculate-price/{numPax}', [PaxCategoryController::class, 'calculateTotalPriceWithExtraPax']);
Route::get('/calculate-total-price/{categoryId}/{numPax}', [PaxCategoryController::class, 'calculateTotalPrice']);

Route::resource('packages', PackageController::class);
Route::resource('paxCategories', PaxCategoryController::class);
Route::resource('documentations', Documentation::class);



// Route::get('/api/full-booked-dates', [BookingController::class, 'getFullBookedDates']);
Route::get('/api/check-availability', [BookingController::class, 'getFullBookedDates']);


Route::get('/booking-info', function (Request $request) {
    $date = $request->query('date', Carbon::today()->toDateString());
    $bookings = Booking::whereDate('selected_date', $date)->get()->groupBy('package_id');

    // Debugging
    return response()->json([
        'date' => $date,
        'bookings' => $bookings,
    ]);
})->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

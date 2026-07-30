<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilityController;

Route::get('/', function () {
    return view('uk-car-booking');
})->name('home');

Route::get('/uk-dashboard', function () {
    return view('uk-dashboard');
})->name('uk-dashboard');

Route::get('/uk-profile', function () {
    return view('uk-profile');
})->name('uk-profile');

Route::get('/uk-about', function () {
    return view('uk-about');
})->name('uk-about');

 Route::get('/uk-terms', function () {
    return view('uk-terms');
})->name('uk-terms');

  Route::get('/uk-privacy', function () {
    return view('uk-privacy');
})->name('uk-privacy');

  Route::get('/uk-contact', function () {
    return view('uk-contact');
})->name('uk-contact');

 Route::get('/uk-global', function () {
    return view('uk-global');
})->name('uk-global');

 Route::get('/uk-preview', function () {
    return view('uk-preview');
})->name('uk-preview');

 Route::get('/operator-signup', function () {
    return view('uk-operator');
})->name('uk-operator');

// Fare calculation route (requires Sanctum token via Authorization header)
Route::get('/w-get-fares', [UtilityController::class, 'DistanceAndDurationAll']);

// Booking endpoints (requires Sanctum token via Authorization header)
Route::post('/w-book-notify-driver', [UtilityController::class, 'BookNotifyDriver']);
Route::post('/w-book-final', [UtilityController::class, 'BookFinal']);
Route::post('/w-payment-break-down', [UtilityController::class, 'PaymentBreakDown']);
Route::post('/w-cash-payment', [UtilityController::class, 'CashPayment']);

// Autocomplete location search
Route::post('/w-get-location', [UtilityController::class, 'GetLocation']);

// Driver Vehicle endpoint
Route::get('/w-driver-vehicle', [UtilityController::class, 'DriverVehicle']);

// Booking Preview endpoint
Route::get('/booking-preview/{key}', [UtilityController::class, 'BookingPreview'])->name('booking-preview');
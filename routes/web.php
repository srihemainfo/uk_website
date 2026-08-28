<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\BlogController;

Route::get('/cache-clear', function () {
    Artisan::call('optimize:clear');
    return response()->json([
        'status' => 'success',
        'message' => 'Optimization cache cleared successfully!',
        'output' => nl2br(Artisan::output())
    ]);
})->name('cache.clear');

Route::get('/', function () {
    return view('car-booking');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/global', function () {
    return view('global');
})->name('global');

Route::get('/preview', function () {
    return view('preview');
})->name('preview');

Route::get('/invoice', function () {
    return view('invoice');
})->name('invoice');

Route::get('/operator-signup', function () {
    return view('operator');
})->name('operator');

Route::get('/stripe/success', function () {
    return view('onboard-success');
})->name('onboard-success');

Route::get('/operator/stripe/success', function () {
    return view('onboard-success');
})->name('onboard-success');

Route::get('/stripe/onboard-status', function () {
    return view('onboard-expiry');
})->name('onboard-expiry');

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

Route::get('/blog', [BlogController::class, 'blogIndex'])->name('blog');
Route::get('/blog/search', [BlogController::class, 'searchBlogs'])->name('blog.search');
Route::get('/blog/{category}', [BlogController::class, 'categoryIndex'])->name('categoryIndex');
Route::get('/blog/{category}/{post}', [BlogController::class, 'blogDetails'])->name('blogDetails');

// UK Route Group for explicit /uk URLs
Route::prefix('uk')->name('uk.')->group(function () {
    Route::get('/', function () {
        return view('car-booking');
    })->name('home');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');

    Route::get('/privacy', function () {
        return view('privacy');
    })->name('privacy');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/blog', [BlogController::class, 'blogIndex'])->name('blog');
    Route::get('/blog/search', [BlogController::class, 'searchBlogs'])->name('blog.search');
    Route::get('/blog/{category}', [BlogController::class, 'categoryIndex'])->name('categoryIndex');
    Route::get('/blog/{category}/{post}', [BlogController::class, 'blogDetails'])->name('blogDetails');

    Route::get('/404', function () {
        return response()->view('errors.404', [], 404);
    })->name('404');
});

Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
})->name('404');

Route::post('/submit-contact', [UtilityController::class, 'submitContactForm'])->name('contact.submit');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
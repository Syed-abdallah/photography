<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SaleAgentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReguserController;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/photography/login');
});
Route::get('/contact_us', function () {
    return view('frontend.contact');
});

Route::get('/photography/dashboard', function () {
    $bookings = Booking::all();
    $events = $bookings->map(function ($booking) {
        return [
            'title' => $booking->name,
            'start' => $booking->created_at->toDateString(), // or ->toISOString() if needed
            'url' => route('bookings.show', $booking->id), // optional
        ];
    });

    return view('dashboard', ['events' => $events]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('photography')->middleware('auth')->group(function () {
    
Route::resource('promotions', PromotionController::class);
Route::resource('services', ServiceController::class);

Route::resource('sale-agents', SaleAgentController::class);

Route::resource('permissions', PermissionController::class);
Route::resource('bookings', BookingController::class);


Route::get('/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');
Route::get('/bookings/events', [BookingController::class, 'getEvents'])->name('bookings.events');




Route::get('/users', [UserController::class, 'index'])->name('user.index');

    // Show registration form
    // Route::get('/registeruser', [RegistrationController::class, 'showRegistrationForm'])
    // ->name('register');


    Route::get('/userregister', [ReguserController::class, 'index'])->name('newuser.register');
    Route::post('/register', [ReguserController::class, 'registeruser'])->name('photography.register.user');
    




Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');







Route::resource('roles', RoleController::class); // This already includes update route
// OR if you need separate:
Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

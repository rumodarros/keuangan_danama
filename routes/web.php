<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DanaDesaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\StaffProfileController;

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

Route::view('/', 'welcome')->name('landing');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/about', 'about')->name('about');

/*
| Auth routes (Breeze) are assumed already registered (auth middleware ready)
| Admin routes (prefix: admin) - protected by 'auth' + 'admin' middleware
*/
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    // Staff CRUD (admin manages staff)
    Route::resource('staff', StaffProfileController::class)->parameters(['staff' => 'staffProfile']);

    // Dana Desa CRUD
    Route::resource('dana', DanaDesaController::class)->parameters(['dana' => 'danaDesa']);

    // Keuangan (admin view/manage all)
    Route::resource('keuangan', KeuanganController::class);
});

/*
| Staff routes (prefix: staff) - protected by 'auth' and staff role check (optional)
| If you want a specific middleware for staff, you can create it like AdminMiddleware and register as 'staff'
*/
Route::prefix('staff')->name('staff.')->middleware(['auth'])->group(function () {
    // staff hanya bisa manage keuangan miliknya (controller meng-handle authorization)
    Route::resource('keuangan', KeuanganController::class);
});

require __DIR__.'/auth.php';

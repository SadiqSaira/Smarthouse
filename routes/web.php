<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LocationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/locations', [LocationController::class, 'index'])->name('location.index');
Route::get('/edit-location/{id}', [LocationController::class, 'edit'])->name('location.edit');
Route::get('/add-location', [LocationController::class, 'add'])->name('location.add');
Route::post('/add-location', [LocationController::class, 'store'])->name('location.store');
Route::get('/locations/{id}', [LocationController::class, 'show'])->name('location.show');
Route::post('/locations/{id}', [LocationController::class, 'store'])->name('location.store');
Route::delete('/delete-location/{id}', [LocationController::class, 'delete'])->name('location.delete');

//we need to select all rooms based on location id.
Route::get('/rooms/{id}', [RoomController::class, 'index'])->name('room.index');
Route::get('/edit-room/{id}', [RoomController::class, 'show'])->name('room.show');
Route::post('/room/{id}', [RoomController::class, 'store'])->name('room.store');
Route::delete('/delete-room/{id}', [RoomController::class, 'delete'])->name('room.delete');


require __DIR__.'/auth.php';

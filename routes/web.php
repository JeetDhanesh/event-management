<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// --- GUEST GROUP (Only for people NOT logged in) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
});

// --- AUTH GROUP (Only for Logged-in Users) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
    // 2. Fetch the data
    $myEvents = Auth::user()->events()->latest()->get(); 
    
    // 3. Send the data to the view using 'compact'
    return view('dashboard', compact('myEvents'));
    })->name('dashboard');

    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // 1. Show the Edit Form
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');

    // 2. Save the Changes (PUT method is used for updates)
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');

    // 3. Delete the Event
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

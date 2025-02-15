<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelationshipController;
use Illuminate\Support\Facades\Route;

// Routes trả về view
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('relationships', RelationshipController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
});

// Routes trả về JSON (API)
Route::prefix('api')->group(function () {
    Route::get('/relationships', [RelationshipController::class, 'getRelationshipData'])->name('getRelationshipData');
    Route::post('/relationships', [RelationshipController::class, 'store'])->name('relationships.store');
    Route::get('/relationships/{id}', [RelationshipController::class, 'edit'])->name('relationships.edit');
    Route::put('/relationships/{id}', [RelationshipController::class, 'update'])->name('relationships.update');
    Route::delete('/relationships/{id}', [RelationshipController::class, 'destroy'])->name('relationships.destroy');
    
    Route::get('/events', [EventController::class, 'getEventData'])->name('getEventData');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    
    Route::get('/members', [MemberController::class, 'getAllMembers'])->name('getAllMembers');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
});

require __DIR__ . '/auth.php';